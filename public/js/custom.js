function addToCart(product_id){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.post( "/api/carts/store", { product_id: product_id })
  .done(function( data ) {
    data = JSON.parse(data);
    if(data.status == 'success'){
      alertify.set('notifier','position', 'top-center');
      alertify.success('Item added to cart successfully!! Total items:'+data.totalItems+ ' Go to checkout page <a href="/carts">Carts</a>');

      $("#totalItems").html(data.totalItems);
    }
  });
}