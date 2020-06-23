@extends('layout.shopify')
@section('content')
{{-- {{$products}} --}}
@if(isset($gift))
<form action="{{ route('gift.update',$gift->id)}}" method="POST">
  {{ method_field('PATCH')}}

  @else
  <form action="{{ route('gift.store')}}" method="POST">
@endif
  @csrf
<div class="Polaris-Page-Header Polaris-Page-Header--hasNavigation Polaris-Page-Header--hasActionMenu Polaris-Page-Header--mobileView">
<div class="Polaris-Page-Header__MainContent ">
  <div class="Polaris-Page-Header__TitleActionMenuWrapper">
      <div>
          <div class="row">
              <div class="col-md-6">
                  <div class="Polaris-Header-Title__TitleAndSubtitleWrapper">
                      <div class="Polaris-Header-Title">
                          <h1 class="Polaris-DisplayText Polaris-DisplayText--sizeLarge">@if(isset($gift))Update Gift @else Create Gift @endif</h1>
                      </div>
                  </div>
              </div>
              <div class="col-md-6 text-right">
                  <button type="submit" class="Polaris-Button Polaris-Button--primary">
                              <span class="Polaris-Button__Content">
                                  <span class="Polaris-Button__Text" style="color: white;">
                                    @if(@isset($gift->title))
                                    Update
                                    @else 
                                    Save
                                    @endif
                                  </span>
                              </span>
                  </button>
              </div>
          </div>
      </div>
  </div>
</div>

<div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
  <div class="Polaris-Card mt-4">
    {{-- <div class="Polaris-Card__Header">
      <h2 class="Polaris-Heading">Online store dashboard</h2>
    </div> --}}

    






    <div class="Polaris-Card__Section mt-4">
     
    

    <form action="{{ route('gift.store')}}" method="POST">
  @csrf


  

  



<div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
  <div class="">
    <div class="Polaris-Labelled__LabelWrapper">
      <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">Gift name</label></div>
    </div>
    <div class="Polaris-Connected">
      <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
        <div class="Polaris-TextField Polaris-TextField--hasValue"><input id="PolarisTextField2" type="text" name="Gift Name" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField2Label" aria-invalid="false" aria-multiline="false" value="@if(isset($gift->title))
          {{$gift->title}}
          @endif">
          <div class="Polaris-TextField__Backdrop"></div>
        </div>
      </div>
    </div>
  </div>
</div>




<div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
  <div class="mt-4">
    <div class="Polaris-Labelled__LabelWrapper">
      <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">Triggerd Price</label></div>
    </div>
    <div class="Polaris-Connected">
      <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
        <div class="Polaris-TextField Polaris-TextField--hasValue"><input id="PolarisTextField2" type="text" name="Triggered Price" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField2Label" aria-invalid="false" aria-multiline="false" value="@if(isset($gift->title))
        {{$gift->triggered_amount}}
        @endif">
          <div class="Polaris-TextField__Backdrop"></div>
        </div>
      </div>
    </div>
  </div>
</div>


  
    <div class="Polaris-SettingAction mt-4">
                                    
      <div class="Polaris-SettingAction__Action"><button type="button" id="upsellModalButton" data-toggle="modal" data-target="#exampleModalScrollable" class="Polaris-Button Polaris-Button--primary"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">@if(isset($gift->title))Change Gift Product @else Select Gift Product @endif </span></span></button></div>
    {{-- <div class="Polaris-SettingAction__Action"><button type="button" class="Polaris-Button Polaris-Button--primary  pull-right"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text"><a href="{{ route('gifts.list')}}">See All Gifts</a></span></span></button></div> --}}
  
      <div>
        {{-- <button type="button" id="upsellModalButton" class="btn btn-outline-secondary  mt-4" data-toggle="modal" data-target="#exampleModalCenter">
        Select Products
        </button> --}}
      
        <!-- Modal -->
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
  
                <div class="Polaris-Modal-Header">
                    <div id="modal-header13" class="Polaris-Modal-Header__Title">
                        <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall"> Choose Product For Gift</h2>
                    </div><button class="Polaris-Modal-CloseButton" data-dismiss="modal" aria-label="Close"><span class="Polaris-Icon Polaris-Icon--colorInkLighter Polaris-Icon--isColored"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
            <path d="M11.414 10l6.293-6.293a.999.999 0 1 0-1.414-1.414L10 8.586 3.707 2.293a.999.999 0 1 0-1.414 1.414L8.586 10l-6.293 6.293a.999.999 0 1 0 1.414 1.414L10 11.414l6.293 6.293a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L11.414 10z" fill-rule="evenodd"></path>
          </svg></span></button>
                </div>
                {{-- <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div> --}}
                <div class="modal-body">
  
                    <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
                        <div class="Polaris-Page">
                     
                          <div class="Polaris-Page__Content">
                            <div class="Polaris-Card">
                              <div class="">
  
                                <section class="Polaris-Modal-Section">
                                    <div class="Polaris-TextField">
                                        <div class="dataTables_filter" id="productsTable_filter"><span class="Polaris-Icon Polaris-Icon--colorInkLighter Polaris-Icon--isColored"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                      <path d="M8 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8m9.707 4.293l-4.82-4.82A5.968 5.968 0 0 0 14 8 6 6 0 0 0 2 8a6 6 0 0 0 6 6 5.968 5.968 0 0 0 3.473-1.113l4.82 4.82a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414" fill-rule="evenodd"></path>
                    </svg></span></div>
                                        <input id="product_search_input" name="search" placeholder="Search " autocomplete="off" class="Polaris-TextField__Input" aria-labelledby="TextField1Label TextField1Prefix" aria-invalid="false" aria-autocomplete="list" aria-controls="Popover1" tabindex="0" aria-owns="Popover1" aria-haspopup="true" aria-expanded="false">
                                        <div class="Polaris-TextField__Backdrop"></div>
                                    </div>
                                </section>
  
                                <div class="Polaris-DataTable__Navigation"><button type="button" class="Polaris-Button Polaris-Button--disabled Polaris-Button--plain Polaris-Button--iconOnly" disabled="" aria-label="Scroll table left one column"><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                            <path d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414L8.414 10l4.293 4.293A.999.999 0 0 1 12 16" fill-rule="evenodd"></path>
                                          </svg></span></span></span></button><button type="button" class="Polaris-Button Polaris-Button--plain Polaris-Button--iconOnly" aria-label="Scroll table right one column"><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                            <path d="M8 16a.999.999 0 0 1-.707-1.707L11.586 10 7.293 5.707a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5A.997.997 0 0 1 8 16" fill-rule="evenodd"></path>
                                          </svg></span></span></span></button></div>
                                <div class="Polaris-DataTable">
                                  <div class="Polaris-DataTable__ScrollContainer">
                                    <table class="Polaris-DataTable__Table" id="productsTable">
                                      {{-- <thead>
                                        <tr>
                                          <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">
                                            <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;"><label class="Polaris-Choice" for="UpsellCheckboxAll"><span class="Polaris-Choice__Control"><span class="Polaris-Checkbox"><input id="UpsellCheckboxAll" type="checkbox" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" value=""><span class="Polaris-Checkbox__Backdrop"></span><span class="Polaris-Checkbox__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                          </svg></span></span></span></span><span class="Polaris-Choice__Label"></span></label></div>
                                        </th>
                                          <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--header" scope="col">Name</th>
                                          <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Vendor</th>
                                          <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Product Type</th>
                                          <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Thumbnail</th>
                                        </tr>
                                       
                                      </thead> --}}
                                      <tbody>
  
  
                                        
                                        @foreach ($products as $product)
  
                                        <tr class="Polaris-DataTable__TableRow">
                                            <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop">
                                                <div class="row polaris_checkbox">
                                                    <label class="Polaris-Choice" for="{{$product->id}}" style="align-items: center">
                            <span class="Polaris-Choice__Control">
                                <span class="Polaris-Checkbox">
                                    <input name="product" id="{{$product->id}}" type="radio" class="Polaris-Checkbox__Input upsell_checkboxes  " aria-invalid="false" role="checkbox" aria-checked="false" aria-checked="false" value="{{$product->id}}" @if(isset($gift))<?php echo ($product->id==$gift->products[0]->id ? 'checked' : '');?> @endif >
                                    <span class="Polaris-Checkbox__Backdrop"></span>
                                    <span class="Polaris-Checkbox__Icon">
                                        <span class="Polaris-Icon">
                                            <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true"><path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path></svg></span></span></span></span>
                                                        <span class="Polaris-Thumbnail Polaris-Thumbnail--sizeSmall"><img src="{{$product->image}}" alt="Responsive Image" class="Polaris-Thumbnail__Image"></span>
                                                        <span class="Polaris-Choice__Label" style="margin-left: 5px;display: inline-block">
                                                            {{$product->title}} 
                                                            <br>
                                                              <p>
                                                                <span class="Polaris-Badge Polaris-Badge--statusSuccess"><span class="Polaris-VisuallyHidden">Success</span><span class="Polaris-Badge__Content">Available</span></span>
                                                                  
                                                              </p>
                                                        </span>
                                                    </label>
                                                </div>
                                            </th>
                                        </tr>
        
                                        {{-- <tr class="Polaris-DataTable__TableRow">
                                          <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" >
        
                                            <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;"><label class="Polaris-Choice" for="{{$product->id}}"><span class="Polaris-Choice__Control"><span class="Polaris-Checkbox"><input id="{{$product->id}}" name="chkbox[]" type="checkbox" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" value="{{$product->id}}"><span class="Polaris-Checkbox__Backdrop" value=""></span><span class="Polaris-Checkbox__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                              </svg></span></span></span></span><span class="Polaris-Choice__Label"></span></label></div>
                                          
                                            </th>
  
                                           
                                            
                                          <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn " scope="row">{{$product->title}}</td>
                                          
                                          <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{$product->vendor}}</td>
                                          <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{$product->product_type}}</td>
                                          <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><img src="https://via.placeholder.com/500x334" alt="image" class="   " height="50" width="50"></td>
                                        </tr> --}}
  
                                        @endforeach
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
                <div class="Polaris-Modal-Footer">
                  <div class="Polaris-Modal-Footer__FooterContent">
                      <div class="Polaris-Stack Polaris-Stack--alignmentCenter">
                          <div class="Polaris-Stack__Item Polaris-Stack__Item--fill"></div>
  
                          <div class="Polaris-Stack__Item">
                              <div class="Polaris-ButtonGroup">
                                  <div class="Polaris-ButtonGroup__Item">
                                      <button type="button" id="modalsave"   class="Polaris-Button Polaris-Button--primary"><span class="Polaris-Button__Content">
                                              <span class="Polaris-Button__Text">Save</span>
                                          </span>
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                {{-- <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
              </div>
            </div>
          </div>
        
  
  
  
  
      </div>
  
  
  
    </div>



    @if(isset($gift->title))
    @foreach ($gift->products as $product)
    <div class="Polaris-DataTable__Navigation"><button type="button" class="Polaris-Button Polaris-Button--disabled Polaris-Button--plain Polaris-Button--iconOnly" disabled="" aria-label="Scroll table left one column"><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                        <path d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414L8.414 10l4.293 4.293A.999.999 0 0 1 12 16" fill-rule="evenodd"></path>
                      </svg></span></span></span></button><button type="button" class="Polaris-Button Polaris-Button--plain Polaris-Button--iconOnly" aria-label="Scroll table right one column"><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                        <path d="M8 16a.999.999 0 0 1-.707-1.707L11.586 10 7.293 5.707a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5A.997.997 0 0 1 8 16" fill-rule="evenodd"></path>
                      </svg></span></span></span></button></div> 
             <div class="Polaris-DataTable">
              <div class="Polaris-DataTable__ScrollContainer">
                <table class="Polaris-DataTable__Table">
                  <thead>
                    <tr>
                      <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Product Image</th>
                      <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--header" scope="col">Product Name</th>
                      <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--header" scope="col">Price</th>
                      
                    </tr>
                    {{-- <tr>
                      <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--total" scope="row">Totals</th>
                      <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--total"></td>
                      <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--total"></td>
                      <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--total Polaris-DataTable__Cell--numeric">255</td>
                      <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--total Polaris-DataTable__Cell--numeric">$155,830.00</td>
                    </tr> --}}
                  </thead>
                  <tbody>
                    <tr class="Polaris-DataTable__TableRow">

                    <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric" ><img src="{{$product->image}}" alt="{{$product->title}}" class=" Polaris-Thumbnail Polaris-Thumbnail--sizeMedium"></th>
                    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn">{{$product->title}}</td>
                      <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn">{{number_format($product->variants[0]->price,2)}} $</td>
                      
                      
                      
                    </tr>
                    
                  </tbody>
                </table>
              </div>
            </div>

        
    @endforeach
            @endif


</div>
</div>
</div>

</form>





@endsection

@section('extra-js')

<script>
  (function(){

    $('#modalsave').click(function(){
      $('#exampleModalScrollable').modal('hide');
             
      

      // jQuery.post('/arcticcool.com/cart/add.js', {
      // items: [
      // {
      // quantity: 1,
      // id: 794864229,
      // }
      // ]
      // });

    });


  })();



</script>

@endsection

