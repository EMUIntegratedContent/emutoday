{{-- For Page Builder --}}
<div id="redips-drag">
    <!-- tables inside this DIV could have drag-able content -->
    <!-- left container -->
    <div class="row">
        <div id="left" class="col-md-6">
            <table id="table1">
                <colgroup>
                    <col width="50"/>
                    <col width="50"/>
                    <col width="50"/>
                    <col width="300"/>
                </colgroup>
                @foreach ($storys as $story)
                <tr>
                    <td class="redips-mark {{$story->is_featured?'frontstory-btn':'smallstory-btn'}}">
                            {{$story->id}}
                    </td>

                    @if($story->is_featured)
                            <td class="redips-mark drag-{{$story->id}}x">
                                <div id="drag-{{$story->id}}x"
                                    class="redips-drag frontstory-btn"
                                    data-stype="{{$story->story_type}}"
                                    data-imgtype="front" data-imgname="{{$story->images()->ofType('front')->first()->filename}}">
                                    {{$story->id}}
                                </div>
                            </td>
                        @else
                            <td class="redips-mark drag-{{$story->id}}">
                                <div id="drag-{{$story->id}}"
                                    class="redips-drag smallstory-btn"
                                    data-stype="{{$story->story_type}}"
                                    data-imgtype="small" data-imgname="{{$story->images()->ofType('small')->first()->filename}}">
                                    {{$story->id}}
                                </div>
                            </td>
                        @endif

                    <td class="redips-mark story-type">
                            {{$story->story_type}}
                    </td>
                    <td class="redips-mark story-title">
                        {{$story->title}}
                    </td>
                </tr>
        @endforeach
    </table>
</div>

        <!-- right container -->
        <div id="right" class="col-md-6">
            <table id="table2">
                <colgroup>
                    <col width="440" />
                </colgroup>
                <tr>
                    <td class="redips-mark">
                        <table class="front-story-table" id="front-story-table0">
                            <colgroup>
                                <col width="440"/>
                            </colgroup>
                            <tr>
                                <td id="storyview0" class="redips-mark front-story-view">

                                </td>
                            </tr>
                            <tr>
                                <td id="emuhome0" class="redips-mark hero redips-single front-story-btn">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="redips-mark">
                        <table id="small-story-table-group">
                            <colgroup>
                                <col width="110"/>
                                <col width="110"/>
                                <col width="110"/>
                                <col width="110"/>
                            </colgroup>
                            <tr>
                                <td class="redips-mark">
                                    <table class="small-story-table" id="small-story-table1">
                                        <colgroup>
                                            <col width="110"/>
                                        </colgroup>

                                        <tr>
                                            <td id="storyview1" class="redips-mark small-story-view">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="emuhome1" class="redips-single small-story-btn">
                                            </tr>

                                        </table>
                                    </td>

                                    <td class="redips-mark">
                                        <table class="small-story-table" id="small-story-table2">
                                            <colgroup>
                                                <col width="110"/>
                                            </colgroup>
                                            <tr>
                                                <td id="storyview2" class="redips-mark small-story-view">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td id="emuhome2" class="redips-single small-story-btn">
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                    <td class="redips-mark">
                                        <table class="small-story-table" id="small-story-table3">
                                            <colgroup>
                                                <col width="110"/>
                                            </colgroup>

                                            <tr>
                                                <td id="storyview3" class="redips-mark small-story-view">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td id="emuhome3" class="redips-single small-story-btn">
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                    <td class="redips-mark">
                                        <table class="small-story-table" id="small-story-table4">
                                            <colgroup>
                                                <col width="110"/>
                                            </colgroup>

                                            <tr>
                                                <td id="storyview4" class="redips-mark small-story-view">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td id="emuhome4" class="redips-single small-story-btn">
                                                </td>
                                            </tr>

                                        </table>
                                    </td>

                                </tr>

                            </table>

                        </td>
                    </tr>

                </table>


                <!-- buttons -->
                <div id="buttons">
                    <input type="button" value="Reset" class="btn bg-olive" onclick="javascript:reset()"/>
                    <input type="button" value="Relocate" class="btn bg-olive" onclick="javascript:reloc()"/>

                </div>
                <!-- display block content -->
                <div id="message"/>
            </div>
        </div>
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Leave</h4>
                    </div>
                    <div class="modal-body">
                        <form class="saveas">
                            {!! Form::token() !!}
                            <input type="hidden" name="_method" id="_method" value="PATCH">

                            {!! Form::hidden('id', '', ['id' => 'hidden-id']) !!}
                            {!! Form::hidden('story_ids', '', ["id"=>"story-ids", "class"=>"inputids"]) !!}
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button id="main-save-as" type="submit" class="btn btn-primary">Save changes</button>
                            {{-- <button id="bugz-submit" class="btn btn-warning btn-block btn-sm" type="submit">Submit</button> --}}

                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div> <!-- END redips-drag -->
