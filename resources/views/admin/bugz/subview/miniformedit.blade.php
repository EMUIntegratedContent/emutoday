<div class="box box-warning hasajax">
            <div class="box-header with-border">
              {{-- <h3 class="box-title">Bug Tracker</h3> --}}
            </div>
            <!-- /.box-header -->
            <!-- form start -->
						<form method="POST"
	      			action="/api/bugz"
	      			  userid="{{$currentUser->id}}"
	  					>

            {{-- <form role="form"> --}}
              <div class="box-body">

								{!! Form::token() !!}


								{!! Form::hidden('user_id', $currentUser->id) !!}

								<div class="form-group">
									{!! Form::label('type') !!}
										{!! Form::select('type', array('bug' => 'bug', 'design' => 'design', 'comment'=> 'commment', 'other'=> 'other'), null, ['placeholder' => 'Type...'] ) !!}

								</div>
								<div class="form-group">
									{!! Form::label('screen') !!}
									{!! Form::text('screen', null, ['class' => 'form-control input-sm']) !!}
								</div>
								<div class="form-group">
									{!! Form::label('notes') !!}
									{!! Form::textArea('notes', null, ['class' => 'form-control input-sm', 'rows'=>'4']) !!}
								</div>
								<div class="form-group">
									{!! Form::label('priority') !!}
									{!! Form::select('priority', array('0' => 'low', '3' => 'medium', '6'=> 'high', '9'=> 'critical'), null, ['placeholder' => 'priority...']) !!}
								</div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
								<button id="bugz-submit" class="btn btn-warning btn-block btn-sm" type="submit">Submit</button>
							</form>
              </div>

          </div>
