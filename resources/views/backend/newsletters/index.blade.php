<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ __('Contacts') }}</h5>

            <div class="d-flex justify-content-between mt-2">
                <form action="">
                    <input type="search" style="width: 300px;" class="form-control" name="search" value="{{request()->search}}" placeholder="{{ __('Search') }}">
                </form>
                {{--  <a href="{{ route('newsletters.create') }}" class="btn btn-primary"><i class="icon-plus-circle2 mr-1"></i> {{ __('Create') }}</a>  --}}
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Quan tâm') }}</th>
                        <th>{{ __('Message') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th class="text-center">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($newsletters as $contact)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->product }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>{{ $contact->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <a href="javascript:void(0)" data-action-url="{{ route('newsletters.destroy', $contact->id) }}" data-behavior="delete-resource" class="dropdown-item"><i class="icon-trash"></i> {{ __('Delete') }}</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $newsletters->appends(request()->except('page'))->links('vendor.pagination.bootstrap-4BK') }}
        </div>
    </div>
</x-app-layout>

