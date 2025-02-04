@extends('admin_layout.master')
@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered card-preview d-none" id="addnewcard">
                        <div class="card-inner">
                            <div class="preview-block">
                                <div class="d-flex justify-content-between">
                                    <span class="preview-title-lg overline-title">Add Faqs</span>
                                    <span style="cursor: pointer;" class="close"><em class="icon ni ni-cross-circle"></em></span>
                                </div>
                                <div class="row gy-4">
                                    <div class="col-sm-12">
                                        <form action="{{ route('Faq.add')}}" method="POST" id="form-data" class="gy-3 form-settings" >
                                            @csrf
                                            <input type="hidden" name="id" id="id" >
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="question">Question</label>
                                                        <span class="form-note">Most asked Questions.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <textarea style="min-height: 60px" class="form-control" id="question" name="question" placeholder="what your team do for us? "></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="description">Description</label>
                                                        <span class="form-note">Describe your Detail.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7" >
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control" id="description" name="description" placeholder="Lorem ipsum....."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary add" id="add">
                                                    <span  id="button_value">Save</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content d-flex justify-content-between">
                            <h4 class="nk-block-title">FAQs</h4>
                            <button class="btn btn-primary" id="addnew">Add Faq</button>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                {{-- <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="true"> --}}
                                    <table class="nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col"><span class="sub-text">Question</span></th>
                                            <th class="nk-tb-col"><span class="sub-text"></span></th>
                                            <th class="nk-tb-col nk-tb-col-tools ">
                                                Display
                                            </th>
                                            <th class="nk-tb-col nk-tb-col-tools text-end">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="sortable" >
                                        @foreach($faqs as $faq )
                                            <tr class="nk-tb-item" data-id="{{ $faq->id }}">
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ Illuminate\Support\Str::words($faq->question ?? '', 10, '...') }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="tb-odr-btns d-none d-sm-inline">
                                                        <a type="button" data-bs-toggle="modal" data-bs-target="#view{{ $faq->id }}" class="btn btn-dim btn-sm btn-primary">View</a>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" data-id="{{ $faq->id }}" id="customSwitch{{ $faq->id }}"  name="status[]" class="custom-control-input changeStatus" {{ $faq->is_displayed ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customSwitch{{ $faq->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools text-end">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                                    data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a class="edit-faq" style="cursor: pointer;" data-id="{{ $faq->id ?? '' }}"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                                        <li><a href="{{ url('admin-dashboard/faq-record-remove') }}/{{ $faq->id }}" class="delete" ><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="view{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="exampleModalLongTitle">{{ $faq->question ?? '' }}</h6>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ $faq->description ?? '' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let editor;
    
        $('.edit-faq').on('click', function() {
            var dataId = $(this).data('id');
            getdata(dataId);
        });

        function getdata(dataId) {
            $.ajax({
                url: "{{ url('admin-dashboard/faq-record') }}" + "/" + dataId,
                type: 'GET',
                success: function(data) {
                    $('#addnewcard').removeClass('d-none');
                    $('#addnew').hide();
                    // $(this).hide();
                    $('#id').val(data.id);
                    $('#question').val(data.question);
                    if (!editor) {
                            editor = ClassicEditor.create(document.querySelector('#description'));
                        }
                        editor.then(editorInstance => {
                            editorInstance.setData(data.description);
                        });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", error);
                }
            });
        }

        $('.changeStatus').on('change',function(){
            var dataId = $(this).data('id');
            $.ajax({
                url: "{{url('/change-faq-status')}}" +"/" + dataId, 
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}' 
                },
                success: function(response) {
                    console.log('Order updated successfully.');
                },
                error: function(xhr) {
                    console.error('Error updating order.');
                }
            });
        });

        $('#addnew').click(function() {
            $('#addnewcard').removeClass('d-none');
            $(this).hide();
            if (!editor) {
                editor = ClassicEditor.create(document.querySelector('#description'));
            }
        });

        $('.close').click(function() {
            $('#addnewcard').addClass('d-none');
            $('#addnew').show();
            $('#id').val('');
            $('#question').val('');
            if (editor) {
                editor.then((editorInstance) => {
                    editorInstance.setData('');
                });
            }
        });

        $("#sortable").sortable({
            update: function(event, ui) {
                var order = $(this).sortable('toArray', { attribute: 'data-id' });
                console.log(order);
                $.ajax({
                    url: "{{url('/update-faq-order')}}", 
                    method: 'POST',
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}' 
                    },
                    success: function(response) {
                        console.log('Order updated successfully.');
                    },
                    error: function(xhr) {
                        console.error('Error updating order.');
                    }
                });
            }
        });
        $("#sortable").disableSelection();
    });
</script>
@endsection