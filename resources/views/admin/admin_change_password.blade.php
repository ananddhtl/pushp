@extends('admin.admin_master')
@section('admin')

<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 offset-md-3">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Change Password</h3>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
							
							<form action="{{ route('update.change.password') }}" method="POST">
								@csrf
								<div class="form-group">
									<label>Old password</label>
									<input type="password" id="current_password" name="oldpassword" class="form-control">
								</div>
								<div class="form-group">
									<label>New password</label>
									<input type="password" id="password" name="password"  class="form-control">
								</div>
								<div class="form-group">
									<label>Confirm password</label>
									<input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
								</div>
								<div class="submit-section">
									<button type="submit" class="btn btn-primary submit-btn">Update Password</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /Page Content -->
			</div>
		</div>
			<!-- /Page Wrapper -->

@stop