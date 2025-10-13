<x-app-layout>
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-radio icon-3x text-success"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="font-weight-semibold mb-0">{{ number_format($channelCount) }}</h3>
                    <span class="text-uppercase font-size-sm text-muted">Channels</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-body">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-phone icon-3x text-indigo"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="font-weight-semibold mb-0">{{ number_format($contactCount) }}</h3>
                    <span class="text-uppercase font-size-sm text-muted">Contacts</span>
                </div>
            </div>
        </div>
    </div>

    {{--  <div class="col-sm-6 col-xl-3">
        <div class="card card-body">
            <div class="media">
                <div class="media-body">
                    <h3 class="font-weight-semibold mb-0">{{ number_format($categoryCount) }}</h3>
                    <span class="text-uppercase font-size-sm text-muted">Danh mục</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-folder-open2 icon-3x text-primary"></i>
                </div>
            </div>
        </div>
    </div>  --}}
</div>
</x-app-layout>