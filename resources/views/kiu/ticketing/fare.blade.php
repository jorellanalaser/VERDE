<table class="table col-md-12 col-xs-12">
    @if(property_exists($pricing, 'Cost'))
        @if(property_exists($pricing->Cost, 'AmountBeforeTax'))
           <!--  <tr>
                <td><b style="color:#669933;text-transform: capitalize !important;">@lang('kiu.itineraries.price')</b></td>
                <td></td>
                <td></td>
                <td><b style="color:#669933;">{{ $pricing->Taxes[0]->Currency }}  {{ \Modules\Helpers\Utilities::number_format( $pricing->Cost->AmountBeforeTax ) }}</b></td>
            </tr>
            @foreach ($pricing->Taxes as $tax)
                <tr>
                    <td></td>
                    <td><span class="label label-success">{{ $tax->Code }}</span></td>

                    <td></td>
                    <td>{{ $tax->Currency }}  {{ \Modules\Helpers\Utilities::number_format( $tax->Amount ) }}</td>
                </tr>
            @endforeach -->
            <tr>
                <td><b style="color:#669933;text-transform: capitalize !important;">@lang('kiu.itineraries.total')</b></td>
                <td></td>
                <td></td>
                <td><b style="color:#669933;">{{ $pricing->Taxes[0]->Currency }}  {{ \Modules\Helpers\Utilities::number_format( $pricing->Cost->AmountAfterTax ) }}</b></td>
            </tr>
        @endif
    @endif
</table>
