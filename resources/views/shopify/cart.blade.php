@extends('layout.shopify')
@section('content')
{{-- <link
  rel="stylesheet"
  href="https://unpkg.com/@shopify/polaris@4.21.0/styles.min.css"
/> --}}
<div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
  <div class="Polaris-Page">
    <div class="Polaris-Page__Content">
      <div class="Polaris-Card">
        <div class="Polaris-SettingAction mt-4">       
          {{-- <div class="Polaris-SettingAction__Action"><button type="button" id="upsellModalButton" data-toggle="modal" data-target="#exampleModalScrollable" class="Polaris-Button Polaris-Button--primary"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Choose Gift Product</span></span></button></div> --}}
          <div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
             <!-- Modal Header-->
                    <div class="Polaris-Modal-Header">
                        <div id="modal-header13" class="Polaris-Modal-Header__Title">
                            <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall"> Here Is Your Gift</h2>
                        </div><button class="Polaris-Modal-CloseButton" data-dismiss="modal" aria-label="Close"><span class="Polaris-Icon Polaris-Icon--colorInkLighter Polaris-Icon--isColored"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                <path d="M11.414 10l6.293-6.293a.999.999 0 1 0-1.414-1.414L10 8.586 3.707 2.293a.999.999 0 1 0-1.414 1.414L8.586 10l-6.293 6.293a.999.999 0 1 0 1.414 1.414L10 11.414l6.293 6.293a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L11.414 10z" fill-rule="evenodd"></path>
              </svg></span></button>
                    </div>
              <!-- Modal Body-->
                    <div class="modal-body">
      
                        <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
                            <div class="Polaris-Page">
                              <div class="Polaris-Page__Content">
                                <div class="Polaris-Card">
                                  <div class="">

                                    <!-- Data Table-->
                                    <div class="Polaris-DataTable__Navigation"><button type="button" class="Polaris-Button Polaris-Button--disabled Polaris-Button--plain Polaris-Button--iconOnly" disabled="" aria-label="Scroll table left one column"><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                <path d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414L8.414 10l4.293 4.293A.999.999 0 0 1 12 16" fill-rule="evenodd"></path>
                                              </svg></span></span></span></button><button type="button" class="Polaris-Button Polaris-Button--plain Polaris-Button--iconOnly" aria-label="Scroll table right one column"><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                <path d="M8 16a.999.999 0 0 1-.707-1.707L11.586 10 7.293 5.707a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5A.997.997 0 0 1 8 16" fill-rule="evenodd"></path>
                                              </svg></span></span></span></button></div>
                                    <div class="Polaris-DataTable">
                                      <div class="Polaris-DataTable__ScrollContainer">
                                        <table class="Polaris-DataTable__Table">
                                   
                                          <tbody>
                                            @forelse ($products as $product)
                                            
                                            <tr class="Polaris-DataTable__TableRow">
                                              <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop">
                                                  <div class="row polaris_checkbox">
                                                      <label class="Polaris-Choice" for="{{$product->id}}" style="align-items: center">
                              <span class="Polaris-Choice__Control">
                                  <span class="Polaris-Checkbox">
                                      <input name="products[]" id="{{$product->id}}" type="checkbox" class="Polaris-Checkbox__Input upsell_checkboxes" aria-invalid="false" role="checkbox" aria-checked="false" aria-checked="false" value="{{$product->id}}">
                                      <span class="Polaris-Checkbox__Backdrop"></span>
                                      <span class="Polaris-Checkbox__Icon">
                                          <span class="Polaris-Icon">
                                              <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true"><path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path></svg></span></span></span></span>
                                                          <span class="Polaris-Thumbnail Polaris-Thumbnail--sizeSmall"><img src="{{$product->image}}" alt="Responsive Image" class="Polaris-Thumbnail__Image"></span>
                                                          <span class="Polaris-Choice__Label" style="margin-left: 5px;display: inline-block">
                                                            {{$product->title}}
                                                            {{-- <p>{{$product->variants}}</p> --}}
                                                              <br>
                                                                <p>
                                                                  <span class="Polaris-Badge Polaris-Badge--statusSuccess"><span class="Polaris-VisuallyHidden">Success</span><span class="Polaris-Badge__Content">Available</span></span>
                                                                    
                                                                </p>
                                                          </span>
                                                      </label>


                                                  </div>
                                              </th>
                                          </tr>
             
                                                
                                            @empty
                                                <div style="text-align:left"> No Items Found</div>
                                            @endforelse
                                            
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <!-- Modal Footer-->
                    <div class="Polaris-Modal-Footer">
                      <div class="Polaris-Modal-Footer__FooterContent">
                          <div class="Polaris-Stack Polaris-Stack--alignmentCenter">
                              <div class="Polaris-Stack__Item Polaris-Stack__Item--fill"></div>
      
                              <div class="Polaris-Stack__Item">
                                  <div class="Polaris-ButtonGroup">
                                      <div class="Polaris-ButtonGroup__Item">
                                          <button type="submit"   class="Polaris-Button Polaris-Button--primary"><span class="Polaris-Button__Content">
                                                  <span class="Polaris-Button__Text">Save</span>
                                              </span>
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                    
                  </div>
                </div>
              </div>
            
      
      
      
      
          </div>
      
      
      
        </div>








        
      </div>
    </div>
  </div>
</div>

<!-- <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
  <div class="Polaris-Card">
    <div class="Polaris-Card__Header">
       <h2 class="Polaris-Heading">Online store dashboard</h2> -->
    <!-- </div>
    <div class="Polaris-Card__Section">
      <p>We Recommend having at least two active offers.<a>Create Offer</a></p>
    </div>
  </div>
</div> -->
@if($gift == 'true')
<script>

(function(){

$(document).ready(function(){
       
       $('#exampleModalScrollable').modal('show');
        });




})();


</script>
@endif

@endsection

@section('extra-js')

{{-- <script>
  (function(){

    



  })();



</script> --}}

@endsection





