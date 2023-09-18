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
    opacity: 0.7;
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
<main class="container-fluid"  >
    <div>
        <div style="margin-top:1rem">
            <b class="text-muted font-weight-bold " style="font-family: fangsong;"> Delivery Status</b>
            <hr>
           
        </div>
      <br />
       <div style="background: linear-gradient(68deg, #ff00000f 60% , #ffff0029 );padding-top: 2rem">
      
       
        <div class=" " style="height: 50rem">
            <div class="d-flex justify-content-end" >
                <input type="text" style="width: 13rem;" onkeyup="all_picked_card_by_search(this)"  placeholder="Search by card no" class="form-control">

            </div>
            <hr>
            <ul class="row" style="padding-left: 0rem" id="show_card">
                   
                
            </ul>
        </div>

    </div>


     
    </div>
</main>

<script>
    async function all_picked_card () {
        const response  = await fetch(`/all_picked_card`)
        const  result = await response.json();
        let view = result.map((item)=>{
            return (`
            <li class="col-sm-12 col-md-6 col-lg-4 mb-2">
                    <div class="card d-flex flex-row justify-content-between" style="height: 10rem">
                        <div class="p-2 card_content_text">
                            
                            <p>Card : ${item.card_no}</p>
                            <p>Reg : 1509002${item.registation_no}</p>
                            <p>Amount : ${item.amount} <i class="fa fa-money" aria-hidden="true"></i></p>
                            <p class="${item.payment == null ?'d-none':''}">Payment : ${item.payment} <i class="fa fa-money" aria-hidden="true"></i></p>
                            <p class="${item.paid == null ?'d-none':''}">Paid : ${item.paid} <i class="fa fa-money" aria-hidden="true"></i></p>
                            <p >Picked by ${item.name} </p>
                             <p class="pb-2 ${item.paid != null || item.payment ==null? 'd-none':''}">
                                <input type="text" id="paid_input_id_${item.id}" placeholder="Payment Paid" style="height: 24px"  class="form-control w-75" >
                             </p>
                        </div>
                        <div class="p-2 d-flex flex-column justify-content-between">

                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled checked>
                                <label class="form-check-label" for="defaultCheck1" >
                                <small><p class="p-0 m-0">Picked</p></small>   
                                </label>
                                </div>
                             
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" ${item.delivery_complete==1 ?'checked':''} disabled >
                                <label class="form-check-label" for="defaultCheck1" >
                                <small><p class="p-0 m-0">Deliveried</p></small>   
                                </label>
                                </div>
                             
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" ${item.payment!= null?'checked':''} disabled >
                                <label class="form-check-label" for="defaultCheck1" >
                                <small><p class="p-0 m-0">Payment</p></small>   
                                </label>
                                </div>

                                <div class="form-group btn-group-sm">
                                   <button onclick="paid_input(${item.id})" class=" ${item.paid != null || item.payment == null ? 'd-none':''} custom_sm_btn btn btn-sm btn-block btn-success w-100">Paid </button>
                                </div>
                             
                        </div>
                      
                    </div>
                </li>
            
            `);
        }).join("")
        show_card.innerHTML= view;
    }

    all_picked_card ()
    
    async function all_picked_card_by_search(e){
        if(e.value ==''){
            all_picked_card ()
             return;
        } 

        const response  = await fetch(`/all_picked_card_by_search/${e.value}`)
        const  result = await response.json();
        let view = result.map((item)=>{
            return (`
            <li class="col-sm-12 col-md-6 col-lg-4 mb-2">
                    <div class="card d-flex flex-row justify-content-between" style="height: 10rem">
                        <div class="p-2 card_content_text">
                            
                            <p>Card : ${item.card_no}</p>
                            <p>Reg : ${item.registation_no}</p>
                            <p>Amount : ${item.amount} <i class="fa fa-money" aria-hidden="true"></i></p>
                            <p class="${item.payment == null ?'d-none':''}">Payment : ${item.payment} <i class="fa fa-money" aria-hidden="true"></i></p>
                            <p class="${item.paid == null ?'d-none':''}">Paid : ${item.paid} <i class="fa fa-money" aria-hidden="true"></i></p>
                            <p >Picked by ${item.name} </p>
                             <p class="pb-2 ${item.paid != null || item.payment ==null? 'd-none':''}">
                                <input type="text" id="paid_input_id_${item.id}" placeholder="Payment Paid" style="height: 24px"  class="form-control w-75" >
                             </p>
                        </div>
                        <div class="p-2 d-flex flex-column justify-content-between">

                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled checked>
                                <label class="form-check-label" for="defaultCheck1" >
                                <small><p class="p-0 m-0">Picked</p></small>   
                                </label>
                                </div>
                             
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" ${item.delivery_complete==1 ?'checked':''} disabled >
                                <label class="form-check-label" for="defaultCheck1" >
                                <small><p class="p-0 m-0">Deliveried</p></small>   
                                </label>
                                </div>
                             
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" ${item.payment!= null?'checked':''} disabled >
                                <label class="form-check-label" for="defaultCheck1" >
                                <small><p class="p-0 m-0">Payment</p></small>   
                                </label>
                                </div>

                                <div class="form-group btn-group-sm">
                                   <button onclick="paid_input(${item.id})" class=" ${item.paid != null || item.payment == null ? 'd-none':''} custom_sm_btn btn btn-sm btn-block btn-success w-100">Paid </button>
                                </div>
                        </div>  
                    </div>
                </li>
            
            `);
        }).join("")
        show_card.innerHTML= view;
    }

    async function paid_input(id){     
   let ElemValue = document.getElementById(`paid_input_id_${id}`).value;
   if(ElemValue != ''){
        let server_data = {
            paid:ElemValue ==''?null:ElemValue,
           id:id
        }

        console.log(server_data)
    
        try {
        const response = await fetch(`/paid_input`,{
        method:'POST',
        body:JSON.stringify(server_data),
        headers: new Headers({
        'Content-Type': 'application/json',
        })
    })

    const result = await response.json();
    
    if(result.condition==true){
        swal("Success!", result.message, "success");
        all_picked_card () 
    }else{
        swal("Opps!", result.message, "error");
    }

} catch (error) {
    swal("Opps!", "Something Went Wrong", "error");
            
        }
    }

    }

</script>

@endsection