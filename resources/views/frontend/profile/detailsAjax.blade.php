<div class="col-md-12">
    <h5 style="color: red">{{ __('site.Ministra details') }}</h5>
    <div class="row">
        <div class="col-md-4">
            <label>{{ __('site.Ministra Url') }}</label>
        </div>
        <div class="col-md-8">
            <p>http://ministra.avirtel.az/stalker_portal/</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label>{{ __('site.Ministra login') }}</label>
        </div>
        <div class="col-md-8">
            <p>{{ $subscription->service->login }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label>{{ __('site.Ministra password') }}</label>
        </div>
        <div class="col-md-8">
            <p>{{ $subscription->service->password }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label>{{ __('site.License key') }}</label>
        </div>
        <div class="col-md-8">
            <p>{{ $subscription->service->license }}</p>
        </div>
    </div>
</div>

