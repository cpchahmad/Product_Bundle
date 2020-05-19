<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.gift .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 25px; /* Location of the box */
  padding-bottom: 50px;
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.gift .modal-content {
  background-color: #fefefe;
  margin: auto;
  
  border: 1px solid #888;
  width: 40%;
}

/* The Close Button */
.gift .gift-close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  padding-right: 15px;
  padding-top: 15px
}

.gift .gift-close:hover,
.gift-close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


  .bkg-green {
    background-color: #227329;
}
.gift-popup>h4 {
    font-size: 30px;
    padding: 20px 30px;
    margin-top: 0;
    margin-bottom: 0;
}
.gift-popup .col-white {
    color: whitesmoke;
}
.gift-popup .col-black1 {
    color: black;
}
.gift-popup .gifts_tier>div {
    margin: 0 30px;
}
.gift_table tr{
    height: 120px;
    display: inline-flex;
}
.gift-popup .woo_gift_select {
    width: 10%;
}
.gift-popup .woo_gift_image {
    width: 30%;
}
.gift-popup .woo_gift_data {
    width: 60%;
}
.gift-popup .single_blade .gift_table td {
    padding-top: 15px;
    padding-bottom: 15px;
}

.gift-popup .chkbox-group {
    width: 25px;
    position: relative;
}
.gift-popup td h3 {
    font-weight: normal;
}
.gift-popup td .gift-title b {
    text-transform: uppercase;
    color: #000;
}

input[type=checkbox], input[type=radio] {
   
    line-height: normal;
    box-sizing: border-box;
    padding: 0;
}
.gift-popup .woo-gift-checkbox {
    margin: 0;
    visibility: hidden;
}
.gift-popup .chkbox-group label {
    cursor: pointer;
    position: absolute;
    width: 25px;
    height: 20px;
    top: 0;
    left: 0;
    background: #fff;
    border: 1px solid #ccc;
    margin: 0;
    outline: 0;
    outline-offset: 0;
    display: inline-block;
    max-width: 100%;
    padding-bottom: 5px;
    font-weight: 700;
}

.gift-popup .chkbox-group input[type=checkbox]:checked+label:after {
    opacity: 1;
}
.gift-popup .chkbox-group label:after {
    border-width: 3px;
    top: 9px;
    left: 7px;
}
.gift-popup .chkbox-group label:after {
    content: '';
    position: absolute;
    width: 9px;
    height: 5px;
    background: transparent;
    
    border: 2px solid #393536;
    border-top: none;
    border-right: none;
    transform: rotate(-45deg);
    box-sizing: border-box;
    
}
.gift-popup td .woo_gift_image {
    width: 80px;
}
.git-popup td img{
    height: auto;
    max-width:100%;
}
.gift-popup td .woo_gift_data {
    padding-left: 20px;
    width: auto;
    padding-top: 0;
    margin-top: 0;
}

.gift-popup td .gift-title {
    margin: 0;
    font-size: 18px;
    margin-bottom: 20px;
    margin-top: 0;
    padding-top: 0;
}
.gift-popup td .gift-title a{
    color: #000;
    text-decoration: none;
    text-align: center;
}
.gift-popup .woo_gift_data .variations {
    display: inline-flex;
    /* table-layout: fixed; */
    width: 90%;
}
.gift-popup .woo_gift_data .variants {
    display: inline-flex;
    /* table-layout: fixed; */
    /* width: 90%; */
}
.gift-popup .woo_gift_data div.label, .gift-popup .woo_gift_data div.value {
    display: inline-block;
    vertical-align: middle;
    padding-top: 10px;
}
.gift-popup .woo_gift_data div.label{
    font-size: 18px;
    width: 30%;
}
.gift-popup .woo_gift_data div.value{
    
    width: 70%;
}

.gift-popup table {
    border-collapse: collapse;
    border-spacing: 0;
}
.gift-popup .gift-actions {
    padding: 20px 0;
    margin-bottom: 50px;
}
.gift-popup .gift-actions>span {
    display: inline-block;
    vertical-align: middle;
    margin-right: -4px;
}
.gift-popup .gift-actions .gift-actions-left {
    width: 70%;
}
.gift-popup .gift-actions .gift-actions-right {
    width: 30%;
    text-align: right;
}
.woo_gift_select_variables{
    width: 100%;
}
.gift-popup .btn{
    
    padding: 14px 18px;
    font-size: 20px;
    text-transform: uppercase;
    font-weight: 600;
    color: #fff;
    background-color: #393536;
}



</style>
</head>
<body>



<!-- Trigger/Open The Modal -->


<!-- The Modal -->
<div class="gift">
<div id="myGiftModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    {{-- <span class="gift-close">&times;</span> --}}
    <div class="mfp-content">
        <div id="woo-gift-popup" class="mfp-popup gift-popup">
            <span class="gift-close">&times;</span>
        <h4 class="col-white bkg-green">YOUV'E EARNED OUR<br><span class="col-black1">NO CHARGE</span> SPECIAL ITEM! </h4>
        
        <div class="gifts_tier">
            <div class="t1_gifts single_blade">
            <table class="gift_table">
                <tbody>
                   
                    <tr class="product woo_gift_row woo_product_variable woo_pv_disabled">
                        <td class="woo_gift_select">
                            <div class="chkbox-group">
                            <input  type="checkbox" name="woo_gift_703[]" id="woo-gift-703" class="woo-gift-checkbox" data-gift-id="703">
                          <label for="woo-gift-703"></label>
                        </div>
                        </td>
                        <td class="woo_gift_image">
                            <div class="woo_gift_thumb">
                            <img width="120" height="90" src="//arcticcool.kinsta.cloud/wp-content/uploads/2019/03/towel_fullview_inside_polarblue-180x180.jpg" >
                        </div>
                          </td>
                          <td class="woo_gift_data">
                              <h3 class="gift-title">
                                  <a href="#"><span>Instant Cooling </span><b>Towel</b></a>
                                </h3>
                                <div class="variants">
                                  <div class="woo_gift_item_cart_content variations_form" >
                                              <div class="variations variations_one">
                                                  <div class="label pa_color_label">
                                                      <label ><b>Color:</b></label>
                                                  </div>
                                                  <div class="value pa_color_value">
                                                  <select  class="woo_gift_select_variables form-control" id="pa_color_10" name="woo_gift_attribute_pa_color_10" >
                                                  <option class="display-none" value="">Add Color</option>
                                                  <option value="cabana-green-midnight-navy" class="attached enabled">Cabana Green/ Midnight Navy</option>
                                                  <option value="pink-punch-storm-grey" class="attached enabled">Pink Punch/Storm Grey</option>
                                                  <option value="polarblue-coolblack" class="attached enabled">Polar Blue/Cool Black</option>
                                                  <option value="storm-grey-cool-black" class="attached enabled">Storm Grey / Cool Black</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="single_variation_wrap"><div class="single_variation woo_gift_item_cart_details" style="display: none;">

                                      </div>
                                  </div>
                              </div>

                              <div class="woo_gift_item_cart_content variations_form" >
                                <div class="variations variations_one">
                                    <div class="label pa_color_label">
                                        <label ><b>Color:</b></label>
                                    </div>
                                    <div class="value pa_color_value">
                                    <select  class="woo_gift_select_variables form-control" id="pa_color_10" name="woo_gift_attribute_pa_color_10" >
                                    <option class="display-none" value="">Add Color</option>
                                    <option value="cabana-green-midnight-navy" class="attached enabled">Cabana Green/ Midnight Navy</option>
                                    <option value="pink-punch-storm-grey" class="attached enabled">Pink Punch/Storm Grey</option>
                                    <option value="polarblue-coolblack" class="attached enabled">Polar Blue/Cool Black</option>
                                    <option value="storm-grey-cool-black" class="attached enabled">Storm Grey / Cool Black</option>
                                </select>
                            </div>
                        </div>
                        <div class="single_variation_wrap"><div class="single_variation woo_gift_item_cart_details" style="display: none;">

                        </div>
                    </div>
                </div>

            </div>
                          </td>
                    </tr>    
                    <tr class="product woo_gift_row woo_product_variable woo_pv_disabled">
                        <td class="woo_gift_select">
                            <div class="chkbox-group">
                            <input  type="checkbox" name="woo_gift_703[]" id="woo-gift-703" class="woo-gift-checkbox" data-gift-id="703">
                          <label for="woo-gift-703"></label>
                        </div>
                        </td>
                        <td class="woo_gift_image">
                            <div class="woo_gift_thumb">
                            <img width="120" height="90" src="//arcticcool.kinsta.cloud/wp-content/uploads/2019/03/towel_fullview_inside_polarblue-180x180.jpg" >
                        </div>
                          </td>
                          <td class="woo_gift_data">
                              <h3 class="gift-title">
                                  <a href="#"><span>Instant Cooling </span><b>Towel</b></a></h3>
                                  <div class="woo_gift_item_cart_content variations_form" >
                                              <div class="variations variations_one">
                                                  <div class="label pa_color_label">
                                                      <label for="pa_color"><b>Color:</b></label>
                                                  </div>
                                                  <div class="value pa_color_value">
                                                  <select  class="woo_gift_select_variables form-control" id="pa_color_10" name="woo_gift_attribute_pa_color_10" >
                                                  <option class="display-none" value="">Add Color</option>
                                                  <option value="cabana-green-midnight-navy" class="attached enabled">Cabana Green/ Midnight Navy</option>
                                                  <option value="pink-punch-storm-grey" class="attached enabled">Pink Punch/Storm Grey</option>
                                                  <option value="polarblue-coolblack" class="attached enabled">Polar Blue/Cool Black</option>
                                                  <option value="storm-grey-cool-black" class="attached enabled">Storm Grey / Cool Black</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="single_variation_wrap"><div class="single_variation woo_gift_item_cart_details" style="display: none;">

                                      </div>
                                  </div>
                              </div>
                          </td>
                    </tr>    
                   
                    
                  </tbody>
              </table>
          </div>
          <hr>
<div class="gift-actions">
  <span class="gift-actions-left">
      <p>View details on all our 
          <a href="#" >Special Offers</a>
          </p>
      </span>
      <span class="gift-actions-right">
          <button type="button"  class="btn " disabled="">ADD ITEM</button>
      </span>
  </div>
 
</div>

</div>
</div>

    
  </div>

</div>
</div>

<script>

    jQuery(function($){
        $(document).ready(function(){
           
            modal.style.display = "block";
             });
       
    });
// Get the modal
var modal = document.getElementById("myGiftModal");



// Get the button that opens the modal


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("gift-close")[0];



// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>
