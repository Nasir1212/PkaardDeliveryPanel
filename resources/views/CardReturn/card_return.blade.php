@extends("Master.layout")
@section("content")
<style>
    .card_content_text{
        margin-bottom: -1rem
    }
   .card_content_text p {
    margin-bottom: 6px;
    font-size: 12px;
    font-weight: bold;
    text-align: justify;
    color: #222121;
}

.card_content_text h5 {
    font-weight: bold;
    color: #878383;
    margin-bottom: 2px;
}

.custom_sm_btn {
    height: 1.4rem;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
}
</style>
<main class="container-fluid"  style="height: 50rem">
    <div>
        <div style="margin-top:1rem">
            <b class="text-muted font-weight-bold " style="font-family: fangsong;"> Card Return </b>
            <hr>
           
        </div>
      <br />
       <div style="background: linear-gradient(68deg, #ff00000f 60% , #ffff0029 );padding-top: 2rem">
       
       
        <div class=" " style="">
            <div class="d-flex justify-content-end" >
                <input type="text" style="width: 13rem;"  placeholder="Search by card no" class="form-control">

            </div>
            <hr>
            <ul class="row" style="padding-left: 0rem" id="show_card">                
            </ul>
        </div>

    </div>


     
    </div>

    

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <small class="text-muted">Card Register Info </small>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-sm">
            <thead class="table-light">
                <tr>
                    <td>Title </td>
                    <td>Information</td>
                </tr>
            </thead>
            <tbody id="card_register_info">
               
            </tbody>
          </table>
        </div>
       
      </div>
    </div>
  </div>
</main>
<script>
    async function show_return_card (e='') {
        let result;
        if(e==''){
        let response = await fetch(`/show_return_card`)
        result = await response.json();
    }
        let view = result.map((item)=>{
            return(`
            <li class="col-sm-12 col-md-6 col-lg-4 mb-2">
                <div class="card d-flex  justify-content-between">
                    <div class="p-2 card_content_text">
                        <p>card  : ${item.card_no}</p>
                        <p>Reg  : 1509002${item.registation_no}</p>
                        <p>Picked by : ${item.name}</p>
                        <button onclick="more_show(${item.registation_no})" style='margin-bottom:1.5px' class="custom_sm_btn btn btn-sm  btn-warning ">More</button>

                    </div>
                    <div class="p-2 d-flex  justify-content-between">
                        <button onclick="redelivery(${item.id})" class="btn btn-sm btn-success">Redelivery</button>
                        <button onclick="unpcking(${item.id})" class="btn btn-sm btn-warning">Unpcking</button>
                    </div>
                    
                </div>
            </li>
            
            `)
        }).join('')
        show_card.innerHTML=view;
    }

    show_return_card();

    async function confirm_redelivery(id){
        try {
    const response = await fetch(`/redelivery/${id}`)
    const result = await response.json();
    if(result.condition==true){
        swal("Success!", result.message, "success");
        show_return_card()
    }else{
        swal("Opps!", result.message, "error");
    }
} catch (error) {
    swal("Opps!", "Something Went Wrong", "error");
            
        }
    }
    
var myModal = new bootstrap.Modal(document.getElementById('myModal'));
async function more_show(data){
    myModal.show();
    const response = await fetch(`${window.location.origin}/card_register/${data}`);
    const result = await response.json();
    let view = result.map((item)=>{
        return(`
        <tr>
            <td>Name</td>
            <td>${item['full_name']}</td>
         </tr>

         <tr>
            <td>Card No</td>
            <td>${item['card_no']}</td>
         </tr>

         <tr>
            <td>Registration No </td>
            <td>1509002${item['card_id']}</td>
         </tr>

         <tr>
            <td>Phone Number</td>
            <td>${item['phone_number']}</td>
         </tr>

         <tr>
            <td>Delivery Address</td>
            <td>
                <span class="${item['cda_division'] == null ? 'd-none':''}"><b> Division </b> :${item['cda_division']}</span>
                <span class="${item['cda_district'] == null ? 'd-none':''}"><b> District </b> :${item['cda_district']}</span>
                <span class="${item['cda_Thana'] == null ? 'd-none':''}"><b> Thana </b>  :${item['cda_Thana']}</span>
                <span class="${item['cda_upzilla'] == null ? 'd-none':''}"><b> Upzilla </b> :${item['cda_upzilla']}</span>
                <span class="${item['cda_village'] == null ? 'd-none':''}"> <b>Village </b> :${item['cda_village']}</span>
                <span class="${item['cda_road_no'] == null ? 'd-none':''}"><b> Road No </b> :${item['cda_road_no']}</span>
                <span class="${item['cda_house_no'] == null ? 'd-none':''}"><b> House No </b> :${item['cda_house_no']}</span>
                <span class="${item['cda_apartment_no'] == null ? 'd-none':''}"><b> Apartment No :${item['cda_apartment_no']}</span>  
            </td>
         </tr>

         <tr>
            <td>Full Address</td>
            <td>${item['cda_address_details']}</td>
         </tr>




        `)
    }).join("")
    card_register_info.innerHTML = view
    }

   async function redelivery(id){
    swal({
  title: "Are you sure?",
  text: "this card is being redelivery to pkaard card holder",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  cancelButtonText: "No",
  closeOnConfirm: false,
  closeOnCancel: true
},
async function(isConfirm){
  if (isConfirm) {
    confirm_redelivery(id)
  }
})
 }

</script>
@endsection