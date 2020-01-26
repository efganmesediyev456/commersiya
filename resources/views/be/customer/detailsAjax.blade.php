<div class="col-md-12">
    <h5 style="color: red">{{ __('Site details') }}</h5>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('Name') }}</label>
        </div>
        <div class="col-md-6">
            <p>{{ $user->name }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('Email') }}</label>
        </div>
        <div class="col-md-6">
            <p>{{ $user->email }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('Password') }}</label>
        </div>
        <div class="col-md-6">
            <p>{{ $user->account_number }}</p>
        </div>
    </div>

    <h5 style="color: red">{{ __('Ministra details') }}</h5>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('Ministra Url') }}</label>
        </div>
        <div class="col-md-6">
            <p>http://ministra.avirtel.az/stalker_portal/</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('Ministra Login') }}</label>
        </div>
        <div class="col-md-6">
            <p>{{ $service->login }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('Ministra password') }}</label>
        </div>
        <div class="col-md-6">
            <p>{{ $service->password }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>{{ __('License key') }}</label>
        </div>
        <div class="col-md-6">
            <p>{{ $service->license }}</p>
        </div>
    </div>
</div>

