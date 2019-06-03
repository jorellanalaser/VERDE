    <?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 16/08/16
 * Time: 09:14 PM
 */

Route::group(['namespace' => 'Kiu'], function (){
    Route::group(['prefix' => 'flights'], function (){
        // AirAvail

        Route::post('/search', [
            'as'    => 'Kiu.AirAvail',
            'uses'  => 'KiuAirAvail@index'
           
        ]);

        // AirPrice
        Route::post('/price', [
            'as'    => 'Kiu.AirPrice',
            'uses'  => 'KiuAirPrice@index'
        ]);

        // Passengers
        Route::post('/passengers', [
            'as'    => 'Kiu.Passengers',
            'uses'  => 'KiuPassengers@index',
            'middleware' => 'email'
        ]);

        // Passengers shopping cart
        Route::get('/passengers', [
            'as'    => 'Kiu.Passengers.ShoppingCart',
            'uses'  => 'KiuPassengers@shopping_cart',
            'middleware' => 'email'
        ]);

        Route::group(['middleware' => ['auth','email']], function (){
            // Kiu AirBook
            Route::post('/booking', [
                'as' => 'Kiu.AirBook',
                'uses' => 'KiuAirBook@index'
            ]);

            Route::get('/booking', [
                'as' => 'Kiu.AirBook.GET',
                'uses' => 'KiuAirBook@index'
            ]);

            // Kiu AirDemand
            Route::post('/ticket', [
                'as' => 'Kiu.AirDemand',
                'uses' => 'KiuAirDemand@index'
            ]);


        });
    });

    Route::group(['middleware' => ['auth','email']], function (){

        Route::post('/', [
        'as' => 'Kiu.ItinRead',
        'uses' => 'KiuItineraryRead@getBooking'
    ]);
    });


    // Kiu ItineraryRead
    Route::get('/{ticket}/read', [
        'as' => 'Kiu.ItinRead.GET',
        'uses' => 'KiuItineraryRead@index'
    ]);

    // Kiu ItineraryRead PDF
    Route::get('/{ticket}/pdf', [
        'as' => 'Kiu.ItinRead.PDF',
        'uses' => 'KiuItineraryRead@pdf'
    ]);

    // Pago online
    Route::group(['prefix' => 'booking'], function (){
        // Kiu ItineraryRead
        

        // Payment
        Route::post('/payment', [
            'as' => 'Kiu.OninePayment',
            'uses' => 'OnlinePayment@index',
            'middleware' => 'auth'
        ]);

        Route::get('/payment', function (){
            return redirect()->to('/');
        });
    });
});