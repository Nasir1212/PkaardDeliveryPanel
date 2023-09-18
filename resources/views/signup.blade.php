<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/index.css') }}">
    <title>Delivery  Sign Up</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
        
        
        <div class="col-12">
    
        
            <div class="signup_container">
        
            <div  class="signup_col" style="height: 50rem" >
    
    
    
            <div style="display: flex;justify-content: center;flex-direction: column;align-items: center;margin-top: 10rem;">
            <h5 class="text-center text-danger" style="font-weight:bold">Pkaard Delivery Sign Up</h5>
            <br/>
    
                <div class="  col-lg-6 col-md-6 col-sm-12">

              
                <div class="card d-flex justify-content-center">
                <div class="card-body ">
                    <form class="row" name="affiliation_partner_form" autoComplete="of">
                        
                
                            <div class="form-group mb-2">
                            <label for="" class="form-label">Name</label>
                            <input type="text"  class="form-control"    name="name" placeholder="Name"/>
                            </div>
                
                            <div class="form-group mb-2">
                            <label for=""  class="form-label">Phone</label>
                            <input type="text"  class="form-control"    name="phone" placeholder="Phone"/>
                            </div>
            
                            <div class="form-group mb-2">
                                <label for=""  class="form-label">Password</label>
                                <input type="text"  class="form-control"    name="Password" placeholder="Password"/>
                            </div>

                            <div class="form-group mb-2">
                                <label for=""  class="form-label">Confirm Password</label>
                                <input type="text"  class="form-control"    name="phone" placeholder="Confirm Password"/>
                            </div>
                
            
                        
                
                            <button  type="button" onclick="handleSignup()" style="width: 96%;margin:auto"  class="btn btn-danger btn-sm">Signup Pkaard Delivery  </button>
                        
                    </form>
                </div> 
                </div>

            </div>
    
            </div>
    
            </div>
            </div>
        </div>
    
        </div>
        
    </div>
  
   <footer>
    <div>
      <p>© Copyright by Pkaard Ltd.|Terms & Conditions</p>
    </div>
   </footer>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>