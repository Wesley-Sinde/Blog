<div class="row">
    <div class="col-xs-12">
    <!-- div.table-responsive -->
        <div class="table-responsive">
            @if (isset($data['rows']) && $data['rows']->count() > 0)
                @php($i = 1)
                <div id="accordion" class="accordion-style2 ui-accordion ui-widget ui-helper-reset ui-sortable" role="tablist">
                    @foreach($data['rows'] as $row)
                        <div class="group">
                            <h3 class="accordion-header ui-accordion-header ui-state-default ui-accordion-icons ui-sortable-handle ui-corner-all" role="tab" id="ui-id-23" aria-controls="ui-id-24" aria-selected="false" aria-expanded="false" tabindex="0">
                                <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>
                                {{ $i.' '.$row->title }}

                            </h3>

                            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-24" aria-labelledby="ui-id-23" role="tabpanel" style="display: none;" aria-hidden="true">
                                <p>
                                    {!! $row->message !!}
                                </p>
                                <div class="align-right" style="font-weight: 600">
                                    <hr class="hr-4">
                                    Publish Date: {{ \Carbon\Carbon::parse($row->publish_date)->format('Y-m-d')}}
                                    <hr class="hr-4">
                                    End Date: {{ \Carbon\Carbon::parse($row->end_date)->format('Y-m-d')}}
                                    <hr class="hr-4">

                                </div>
                            </div>
                        </div>

                        @php($i++)
                    @endforeach
                </div>
            @else
                No data found.
            @endif
        </div>
    </div>
</div>