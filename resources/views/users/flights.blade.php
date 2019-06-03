@extends('layouts.simplepage')

@section('content')
    <div class="container">
        <div class="row row-bottom-padded-lg to-animate">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p style="font-size:200%; color:#87bc24;" align="left">
                            <a href="{{ route('user.dashboard') }}">
                                <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMxLjA1OSAzMS4wNTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMxLjA1OSAzMS4wNTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzAuMTcxLDE2LjQxNkgwLjg4OEMwLjM5OCwxNi40MTYsMCwxNi4wMiwwLDE1LjUyOWMwLTAuNDksMC4zOTgtMC44ODgsMC44ODgtMC44ODhoMjkuMjgzICAgIGMwLjQ5LDAsMC44ODgsMC4zOTgsMC44ODgsMC44ODhDMzEuMDU5LDE2LjAyLDMwLjY2MSwxNi40MTYsMzAuMTcxLDE2LjQxNnoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNi4wMTcsMzEuMDU5Yy0wLjIyMiwwLTAuNDQ1LTAuMDgzLTAuNjE3LTAuMjVMMC4yNzEsMTYuMTY2QzAuMDk4LDE1Ljk5OSwwLDE1Ljc3LDAsMTUuNTI5ICAgIGMwLTAuMjQsMC4wOTgtMC40NzEsMC4yNzEtMC42MzhMMTUuNCwwLjI1YzAuMzUyLTAuMzQxLDAuOTE0LTAuMzMyLDEuMjU1LDAuMDJjMC4zNCwwLjM1MywwLjMzMSwwLjkxNS0wLjAyMSwxLjI1NUwyLjE2MywxNS41MjkgICAgbDE0LjQ3MSwxNC4wMDRjMC4zNTIsMC4zNDEsMC4zNjEsMC45MDIsMC4wMjEsMS4yNTVDMTYuNDgsMzAuOTY4LDE2LjI0OSwzMS4wNTksMTYuMDE3LDMxLjA1OXoiIGZpbGw9IiNiN2MwYzciLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" style="height:auto; width:5%; margin-right:20px;" />
                            </a>

                            {{ trans('dashboard.my_flights') }}
                        </p>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('kiu.itineraries.booking')</th>
                                <th>@lang('kiu.itineraries.status.title')</th>
                                <th>@lang('kiu.itineraries.departure')</th>
                                <th>@lang('kiu.itineraries.arrival')</th>
                                <th>@lang('kiu.itineraries.createdAt')</th>
                                <th>@lang('kiu.itineraries.departureDate')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->booking_ref }}</td>
                                    <td>
                                        @if($booking->status == 'booking')
                                            <div class="label label-info col-xs-12">@lang('kiu.itineraries.status.' . $booking->status)</div>
                                        @elseif($booking->status == 'emmited')
                                            <div class="label label-success col-xs-12">@lang('kiu.itineraries.status.' . $booking->status)</div>
                                        @elseif($booking->status == 'cancel')
                                            <div class="label label-danger col-xs-12">@lang('kiu.itineraries.status.' . $booking->status)</div>
                                        @else
                                            <div class="label label-default col-xs-12">{{ $booking->status }}</div>
                                        @endif
                                    </td>
                                    <td>{{ \Modules\Helpers\AirportHelper::cityByCode( $booking->itineraries[0]->origin ) }}</td>
                                    <td>{{ \Modules\Helpers\AirportHelper::cityByCode( $booking->itineraries[0]->destination ) }}</td>
                                    <td class="text-uppercase">
                                        {{ \Carbon\Carbon::parse( $booking->created_at )->format('dMy H:i') }}
                                    </td>
                                    <td class="text-uppercase">
                                        {{ \Carbon\Carbon::parse( $booking->itineraries[0]->departure_datetime )->format('dMy H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="7" class="text-center">
                                    {{ $bookings->links() }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection