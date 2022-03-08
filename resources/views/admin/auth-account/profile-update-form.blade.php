<div class="card-body">
    <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="{{$user->first_name}}" required>
            </div>

            <div class="col-md-12 mb-3">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{$user->last_name}}" required>
            </div>

            <div class="col-md-12 mb-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="{{$user->phone}}" required readonly>
            </div>

            <div class="col-md-12 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="{{$user->email}}">
            </div>

            <div class="col-md-12 mb-3">
                <label for="photo">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
        </div>
        <button class="btn btn-primary"><i class="ti-save"></i> Update</button>
    </form>
</div>
