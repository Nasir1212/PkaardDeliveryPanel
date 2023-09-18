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

.card_content_text h5{

}
</style>
<main class="container-fluid"  style="height: 50rem">
    <div>
        <div style="margin-top:1rem">
            <b class="text-muted font-weight-bold " style="font-family: fangsong;">Home Page </b>
            <hr>
           
        </div>
      <br />
       <div class="" style="background: linear-gradient(68deg, #ff00000f 60% , #ffff0029 );padding-top: 2rem">
        <div class="d-flex justify-content-center gap-2 flex-lg-row flex-md-row flex-column mb-2">
          
            @component("Home.Component.FormView") @endcomponent
            @component("Home.Component.ListView") @endcomponent
        </div>
       
        <div class=" " style="">
            

            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row flex-lg-row ">

                <div>
                    <h6 class="font-weight-bold text-muted p-2 bg-warning">Packing Cards </h6>
                </div>

                <div class="" >
                    <input type="text" style="width: 13rem;" onkeyup="show_all_packing_card_by_search(this);" placeholder="Search by card no" class="form-control">
                </div>
               
            </div>
            <hr>
            <ul class="row" style="padding-left: 0rem" id="show_card">
             

              
                
                
            </ul>
        </div>

    </div>


     
    </div>
</main>

<script>
async  function  get_card_delivery(){

   // show_all_packing_card

let list_group = document.getElementById("list_group")



let response = await Promise.all([fetch("/get_card_delivery"),fetch("/show_all_packing_card")]);
const get_card_delivery = await response[0].json();
const show_all_packing_card = await response[1].json();

let listView = get_card_delivery.map((item)=>{
    return (`
        <li class="list-group-item list-group-item-action d-flex gap-1">
            <div >
                <p class="p-0 m-0">Name : ${item['full_name']} </p>
                <p class="p-0 m-0">Reg  :1509002${item['registation_no']} </p>
            </div>
            <div>
                <div class="form-check">
                    <input class="form-check-input"  id="${item["registation_no"]}" name="packing_checkbox" type="checkbox" onclick="check_for_packing(this)" id="flexCheckDefault">

                    </div>
            </div>
            
        </li>
    
    `);

}).join('')

list_group.innerHTML = listView

let listCard = show_all_packing_card.map((item)=>{
return (`

<li class="col-sm-12 col-md-6 col-lg-4 mb-2">
    <div class="card d-flex  justify-content-between">
        <div class="p-2 card_content_text">
            <h5>${item['full_name']}</h5>
            <p>card-no : ${item['card_no']}</p>
            <p>Reg-no : 1509002${item['registation_no']}</p>
            <p>Amount : ${item['amount']} <i class="fa fa-money" aria-hidden="true"></i></p>
        
        </div>
        <div class="p-2 d-flex  justify-content-end">                
            <div onclick="unpacking_card(${item['id']});" style="cursor: pointer"><i class="fa fa-trash" aria-hidden="true"></i></div>  
        </div>
        
    </div>
</li>


`)

}).join('')

document.getElementById("show_card").innerHTML = listCard

    }

    get_card_delivery();

    function check_for_packing(e){
        let formElem = document.forms['packing_card_box']
        let {id,name} =e ;
        for ( const  elem  of document.getElementsByName(name)) {
            elem.checked =false;
        } ;
         e.checked = true;
         formElem.registration.value = id;
         formElem.card_number.focus();
    }

  async function handle_packing(form){
   let formData =  Object.fromEntries(new FormData(form));
   formData['registration'] = form.elements['registration'].value

   
   try {   
    const response = await fetch(`/handle_packing`,{
        method:'POST',
        body:JSON.stringify(formData),
        headers: new Headers({
        'Content-Type': 'application/json',

        })
    })

    const result = await response.json();
    if(result.condition==true){
        swal("Success", result.message, "success")
        for (const elem  of form.elements) elem.value=''
        get_card_delivery();
    }else{
        swal("Opps !", result.message, "error")
    }
} catch (error) {
    swal("Opps !", "Something went wrong", "error")
    console.log(error)
}

}

async function unpacking_card(id){

    try {
    
    const response = await fetch(`/unpacking_card/${id}`);
    const result = await response.json();

    if(result.condition==true){
        swal("Success", result.message, "success")
        get_card_delivery();
    }else{
        swal("Opps !", result.message, "error")
    }
        
} catch (error) {
    swal("Opps !", "Something went wrong", "error")
    console.log(error)
    }


}

async function show_all_packing_card_by_search(e){

    const response = await fetch(`/show_all_packing_card_by_search/${e.value}`);
    const result = await response.json();

    let listCard = result.map((item)=>{
return (`

<li class="col-sm-12 col-md-6 col-lg-4 mb-2">
    <div class="card d-flex  justify-content-between">
        <div class="p-2 card_content_text">
            <h5>${item['full_name']}</h5>
            <p>card-no : ${item['card_no']}</p>
            <p>Reg-no : 1509002${item['registation_no']}</p>
            <p>Amount : ${item['amount']} <i class="fa fa-money" aria-hidden="true"></i></p>
        
        </div>
        <div class="p-2 d-flex  justify-content-end">                
            <div onclick="unpacking_card(${item['id']});" style="cursor: pointer"><i class="fa fa-trash" aria-hidden="true"></i></div>  
        </div>
        
    </div>
</li>


`)

}).join('')

document.getElementById("show_card").innerHTML = listCard

}



</script>

@endsection
