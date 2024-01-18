@extends('layouts.app')

@push('head-styles')
    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success my-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div id="formErrors" class="alert alert-danger print-error-msg" style="display:none;">
                <ul></ul>
            </div>
            <div class="card">
                <div class="card-header row d-flex">
                    <div class="col">
                        {{ __('Edit the ') }} {{ $template->name }} {{ __('template') }}
                    </div>
                    <div class="col text-end">
                        @if ($template->subject)
                            <form method="POST" action="{{ route('send.mail') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{$template->id}}" />
                                <button type="submit" class="btn btn-primary btn-sm">Test mail</button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    @if (count($options) > 0)
                        <p>Option values</p>
                        @foreach ($options as $i)
                            <p>{{$i->value}}</p>
                        @endforeach
                    @endif
                    <form method="POST" action="">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$template->id}}" />
                        <div class="form-group mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" class="form-control" name="subject" value="{{ $template->subject ? $template->subject : '' }}" required />
                            <div id="subjectError"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="editor" class="form-label">Email body</label>
                            <div id="editor"></div>
                            <textarea id="content" name="content" style="display:none;"></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="onSubmit()">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer-scripts')
    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script type="text/javascript">
        // Initilise quill editor
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        // insert quill data
        $(function() {
            quill.root.innerHTML = '{!! $template->content !!}';
        });
        
        // submit the form
        function onSubmit() {
            var myEditor = document.querySelector('#editor');
            // store the quill editor html content
            var html = myEditor.children[0].innerHTML;
            let content = $("#content").html(html); // hidden content value
            let subject = $('input[name="subject"]').val(); // subject value
            let id = $('#id').val(); // hidden id value
            // check the subject field is not empty
            // display error if empty
            $('#subjectError').html('');
            if (!subject) {
                return $('#subjectError').html(`<p class="text-danger">Please enter a subject</p>`);
            }
            $.ajax({
                type:'POST',
                url:"{{ route('update.template') }}",
                data:{
                    _token: "{{ csrf_token() }}",
                    id: id,
                    subject: subject,
                    content: content.val()
                },
                success:function(response){
                    location.replace(`/template/${id}`);
                },
                error: function(response){
                    $('#formErrors').find('ul').html('');
                    $('#formErrors').css('display','block');
                    $.each(response.responseJSON.errors, function(key, value) {
                        $('#formErrors').find('ul').append(`<li>${value}</li>`);
                    });
                }
            });
        }
    </script>
@endpush
