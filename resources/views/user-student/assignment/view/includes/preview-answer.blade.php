<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div>
            <table class="table table-striped table-bordered table-hover">
                <tr >
                    <td class="label-info white">Status</td>
                    <td>
                        @if( $data['answers']->approve_status == 1)
                            <button class="btn btn-success btn-minier dropdown-toggle" >
                                Approve
                            </button>
                        @elseif( $data['answers']->approve_status == 2)
                            <button class="btn btn-danger btn-minier dropdown-toggle" >
                                Rejected
                            </button>
                        @else
                            <button class="btn btn-info btn-minier dropdown-toggle" >
                                Pending
                            </button>
                        @endif
                    </td>
                    <td class="label-info white">File</td>
                    <td>
                        @if($data['answers']->file)
                            <a href="{{ asset('assignments'.DIRECTORY_SEPARATOR.'answers'.DIRECTORY_SEPARATOR.$data['answers']->file) }}" target="_blank" >
                                Attachment File
                                <i class="ace-icon fa fa-download bigger-120"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                <tr >
                    <td class="label-info white">CreatedBy</td>
                    <td>
                        @if($data['answers']->created_by)
                            {{  ViewHelper::getUserNameId( $data['answers']->created_by ) }}
                            {{-- {{ auth()->user()->where('id',$data['answers']->created_by)->first()->name }}--}}
                        @endif
                    </td>
                    <td class="label-info white">UpdatedBy</td>
                    <td>
                        @if($data['answers']->last_updated_by)
                            {{  ViewHelper::getUserNameId( $data['answers']->last_updated_by ) }}
                            {{--{{ auth()->user()->where('id',$data['answers']->last_updated_by)->first()->name }}--}}
                        @endif
                    </td>
                </tr>
                <tr >
                    <td class="label-info white">CreatedOn</td>
                    <td>{{ \Carbon\Carbon::parse($data['answers']->created_at)->format('M d, Y')}} </td>
                    <td class="label-info white">UpdateOn</td>
                    <td>{{ \Carbon\Carbon::parse($data['answers']->updated_at)->format('M d, Y')}} </td>
                </tr>
                <tr >
                    <td class="label-info white">Detail</td>
                    <td colspan="4">{!! $data['answers']->answer_text !!}</td>
                </tr>
            </table>
        </div>
    </div>
</div><!-- /.row -->




