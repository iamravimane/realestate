@csrf
<div class="form-group">
    <label for="name" class="sr-only">Name</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
           value="{{ old('name') }} @isset($user) {{ $user->name }} @endisset"  autocomplete="name" autofocus placeholder="Name">
    @error('name')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>

<div class="form-group">
    <label for="email" class="sr-only">Email</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
           value="{{ old('email') }}  @isset($user) {{ $user->email }} @endisset"  autocomplete="email" placeholder="Email address">
    @error('email')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group">
    <label for="email" class="sr-only">Photo</label>
    <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
</div>

@isset($create)
<div class="form-group mb-4">
    <label for="password" class="sr-only">Password</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Password">
    @error('password')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>

<div class="form-group mb-4">
    <label for="password_confirmation" class="sr-only">Password Confirm</label>
    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password" placeholder="password_confirmation">
    @error('password')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>

@endisset

<div class="form-group mb-4">
    @foreach($roles as $role)
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="roles[]"
                   value="{{ $role->id }}" id="{{ $role->name }}"
             @isset($user)
                   @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked
                @endif
                @endisset
            >

            <label for="{{ $role->name }}" class="form-check-label">
                {{ $role->name }}
            </label>
        </div>
    @endforeach
</div>
<input name="register" id="register" class="btn btn-block btn-success login-btn mb-4" type="submit" value="Submit">
