
<!--<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="'form-control'" name= "$user->name" . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="'form-control'" name= "$user->email" . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label>Role</label>
            <input type="text" class="'form-control'" name= "$user->role" . ($errors->has('role') ? ' is-invalid' : ''), 'placeholder' => 'Role']) }}
            {!! $errors->first('role', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div> -->


<div class="box box-info padding-1">
    <div class="box-body">

    <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Name</label>
    <input type="name" class="form-control" id="exampleFormControlInput1" placeholder="Juancito Ortiz" value="{{ old('name', $user->name) }}">
    </div>
    <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@user.com" value="{{ old('email', $user->email) }}">
    </div>
    <label for="exampleFormControlInput1" class="form-label">Role</label>
    <select class="form-select" aria-label="Role">
    <option selected></option>
    <option value="1">client</option>
    <option value="2">admin</option>
    </select>
    <br>
    <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary">Update</button>
    </div>
</div>