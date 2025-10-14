@extends('admin.master')

@section('content')
    <div class="page-container">
    <div class="col-lg-12">
    <div class="card">
        <div class="card-header border-bottom border-dashed d-flex align-items-center">
            <h4 class="header-title">Horizontal form</h4>
        </div>

        <div class="card-body">
            <p class="text-muted">Create horizontal forms with the grid by adding the <code>.row</code> class to form groups and using the <code>.col-*-*</code> classes to specify the width of your labels and controls. Be sure to add <code>.col-form-label</code> to your <code>&lt;label&gt;</code>s as well so they’re vertically centered with their associated form controls.</p>

            <form class="form-horizontal">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-3 col-form-label">Email</label>
                    <div class="col-9">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-3 col-form-label">Password</label>
                    <div class="col-9">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword5" class="col-3 col-form-label">Re Password</label>
                    <div class="col-9">
                        <input type="password" class="form-control" id="inputPassword5" placeholder="Retype Password">
                    </div>
                </div>
                <div class="row mb-3 justify-content-end">
                    <div class="col-9">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkmeout">
                            <label class="form-check-label" for="checkmeout">Check me out !</label>
                        </div>
                    </div>
                </div>
                <div class="justify-content-end row">
                    <div class="col-9">
                        <button type="submit" class="btn btn-info">Sign in</button>
                    </div>
                </div>
            </form>
        </div> <!-- end card-body -->
    </div> <!-- end card -->
</div> <!-- end col -->
    </div>
 @endsection
