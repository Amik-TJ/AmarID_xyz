@extends('layouts.admin_layout')
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-md-12 mt-lg-4 mt-4">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    @if($data['found'])
                        <h3 class="card-subtitle text-success h3 mb-0">Overview of All FAQS</h3>
                    @else
                        <h5 class="card-subtitle text-danger h3 mb-0">No FAQS have been created yet!</h5>
                    @endif
                    <button type="button" class=" btn-sm btn-success shadow-sm"
                            data-toggle="modal" data-target="#create_faq_modal"><i class="fa fa-question-circle" aria-hidden="true"></i>
                        Create a New FAQ
                    </button>
                </div>
            </div>
        {{----------------------------------Table Starts-------------------------------------------}}

        <!-- column -->
            <div class="col-md-12 mt-4">
                <div class="card">
                    @if($data['found'])
                        <div class="table-responsive">
                            <table class="table v-middle table-hover" id="datatable">
                                <thead>
                                <tr class="bg-light">
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">FAQ ID</th>
                                    <th class="border-top-0">Question</th>
                                    <th class="border-top-0">Answer</th>
                                    <th class="border-top-0">Edit</th>
                                    <th class="border-top-0">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0
                                @endphp
                                @foreach($data['data'] as $all)
                                    <tr>
                                        <td>{{++$count}}</td>
                                        <td>{{$all->faqID}}</td>
                                        <td>
                                            @if(strlen($all->question) < 110)
                                                {{$all->question}}
                                            @else
                                                {{substr($all->question, 0, 80)}}.....
                                                <a href="" type="button" data-toggle="modal" data-target="#view_more_modal" data-faq_id="{{$all->faqID}}" data-answer="{{$all->answer}}"  data-question="{{$all->question}}">
                                                    Show More
                                                </a>
                                            @endif
                                        <td >
                                            @if(strlen($all->answer) < 110)
                                                {{$all->answer}}
                                            @else
                                                {{substr($all->answer, 0, 80)}}.....
                                                <a href="" type="button" data-toggle="modal" data-target="#view_more_modal" data-faq_id="{{$all->faqID}}" data-answer="{{$all->answer}}"  data-question="{{$all->question}}">
                                                    Show More
                                                </a>
                                            @endif
                                        </td>
                                        <td class="mx-auto">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_faq_modal" data-faq_id="{{$all->faqID}}" data-question="{{$all->question}}" data-answer="{{$all->answer}}">Edit</button>
                                        </td>
                                        <td>
                                            <form action="/delete_faq" method="post" class="float-sm-right">
                                                @csrf

                                                <input type="hidden" name="faq_id" value="{{$all->faqID}}">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>







    <!------------------------------------Add FAQ Modal Starts ------------------------------->
    <div class="modal fade" id="create_faq_modal" tabindex="-1" role="dialog"
         aria-labelledby="create_faq_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bold" id="create_faq_modalLongTitle">Create a new FAQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/create_new_faq">
                        @csrf
                        <div class="form-group">
                            <label for="question" class="col-form-label "><span class="text-danger font-weight-bold">Question:</span></label>
                            <textarea class="form-control" id="question" rows="4" name="question"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="answer" class="col-form-label"><span class="text-success font-weight-bold">Answer:</span></label>
                            <textarea class="form-control" id="answer" rows="4" name="answer"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-------------------------Modal---------------------------}}






    <!--------------------------------Edit Modal Starts------------------------------------>



    <div class="modal fade" id="edit_faq_modal" tabindex="-1" role="dialog" aria-labelledby="edit_faq_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bold" id="edit_faq_modalLabel">Edit Faq No :  <span class="text-dark font-weight-bold" id="m_t_faq_id"> </span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/edit_faq">
                        @csrf
                        <input type="hidden" id="m_faq_id" name="faq_id" value="">
                        <div class="form-group">
                            <label for="m_question" class="col-form-label "><span class="text-danger font-weight-bold">Question:</span></label>
                            <textarea class="form-control" id="m_question" rows="4" name="question"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="m_answer" class="col-form-label"><span class="text-success font-weight-bold">Answer:</span></label>
                            <textarea class="form-control" id="m_answer" rows="5" name="answer"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------Edit Modal Ends------------------------------------>


    {{--------------------------------View More Details Modal Starts---------------------------}}

    <!-- Modal -->
    <div class="modal fade" id="view_more_modal" tabindex="-1" role="dialog" aria-labelledby="view_more_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-centers text-secondary font-weight-bold" id="view_more_modal_title">FAQ No  :  <span id="s_faq_id"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="font-weight-bold text-danger">
                        Question :
                    </h4>
                    <p id="s_faq_question">.........</p>
                    <h4 class="font-weight-bold text-success">
                        Answer :
                    </h4>
                    <p id="s_faq_answer">..........</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    {{--------------------------------View More Details Modal Starts---------------------------}}

@endsection



@section('edit_js')
    <script>
        $('#edit_faq_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var faq_id = button.data('faq_id')
            var question = button.data('question')
            var answer = button.data('answer')
            var modal = $(this)
            console.log(faq_id);
            modal.find('.modal-body #m_faq_id').val(faq_id)
            document.getElementById("m_t_faq_id").innerHTML = faq_id
            //modal.find('.modal-body #m_t_faq_id').val(faq_id)
            modal.find('.modal-body #m_question').val(question)
            modal.find('.modal-body #m_answer').val(answer)
        })


        $('#view_more_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var faq_id = button.data('faq_id')
            var question = button.data('question')
            var answer = button.data('answer')
            var modal = $(this)

            document.getElementById("s_faq_id").innerHTML = faq_id
            document.getElementById("s_faq_answer").innerHTML = answer
            document.getElementById("s_faq_question").innerHTML = question


        })
    </script>
@endsection
