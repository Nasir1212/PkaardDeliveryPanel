<div class="card " style="">
    <div class="card-headr ">
        <h5 class="card-title d-flex justify-content-center align-items-center mt-2 text-muted font-weight-bold">Pkaard Delivery Packaging </h5>

    </div>
    <div class="card-body">
    <div >
        <form name="packing_card_box">
            <div class="form-group">
            <label for="">Card Number</label>
            <input type="text" name="card_number" id="" class="form-control" placeholder="Enter Card Number">
            </div>

            <div class="form-group">
            

                <label for="">Registration  Number</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend2">1509002 - </span>
                    </div>
                    <input type="text"  class="form-control" name="registration" placeholder="x x x x" disabled>
                </div>
            </div>

            <div class="form-group">
              
                <label for=""> Amount </label>
                <input type="text" name="amount" id="" class="form-control" placeholder="Enter Amount" >
            </div>
            <div class="form-group">
                <button type="button" onclick="handle_packing(document.forms['packing_card_box'])" class="btn btn-sm btn-success mt-1 w-100 font-weight-bold">Packing</button>
            </div>
        </form>
    </div>
    </div>
</div>