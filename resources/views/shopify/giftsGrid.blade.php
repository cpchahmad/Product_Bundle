@extends('layout.shopify')
@section('content')
{{-- <link
  rel="stylesheet"
  href="https://unpkg.com/@shopify/polaris@4.21.0/styles.min.css"
/> --}}
<div class="Polaris-Page-Header Polaris-Page-Header--hasNavigation Polaris-Page-Header--hasActionMenu Polaris-Page-Header--mobileView">
  <div class="Polaris-Page-Header__MainContent">
      <div class="Polaris-Page-Header__TitleActionMenuWrapper">
          <div>
              <div class="row">
                  <div class="col-md-6">
              <div class="Polaris-Header-Title__TitleAndSubtitleWrapper">
                  <div class="Polaris-Header-Title">
                      <h1 class="Polaris-DisplayText Polaris-DisplayText--sizeLarge">Gifts Collection</h1>
                  </div>
              </div>
                  </div>
                  <div class="col-md-6 text-right">
                      <a href="{{ route('admin.products.sync') }}" class="Polaris-Button Polaris-Button--primary">
                              <span class="Polaris-Button__Content">
                                  <span class="Polaris-Button__Text" style="color: white;">Sync Products</span>
                              </span>
                      </a>

                      <a href="{{ route('gift.create') }}" class="Polaris-Button Polaris-Button--primary">
                              <span class="Polaris-Button__Content">
                                  <span class="Polaris-Button__Text" style="color: white;">Add New</span>
                              </span>
                      </a>
                  </div>
          </div>
      </div>
  </div>
</div>
    <div class="Polaris-Page__Content">
      <div class="Polaris-Card">


        <div class="">
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
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Image</th>
                      <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Gift Name</th>
                      <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--header" scope="col">Threshold</th>
                      <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--header" scope="col">Status</th>
                      <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--header" scope="col"></th>
                    </tr>
                    
                  </thead>
                  <tbody>
                      @foreach ($gifts as $gift)
                          
                      
                    <tr class="Polaris-DataTable__TableRow">
                     <!-- <td class="Polaris-Thumbnail Polaris-Thumbnail--sizeSmall"style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;"><img src="https://burst.shopifycdn.com/photos/black-leather-choker-necklace_373x@2x.jpg" alt="Black choker necklace" class="Polaris-Thumbnail__Image"></td> -->
                     <td class="Polaris-DataTable__Cell  Polaris-DataTable__Cell--firstColumn " scope="row"><img src="{{$gift->products[0]->image}}" alt="{{$gift->title}}" class=" Polaris-Thumbnail Polaris-Thumbnail--sizeMedium"></td>
                    
                      <td class="Polaris-DataTable__Cell  Polaris-DataTable__Cell--firstColumn" >{{$gift->title}}</td>
                      <td class="Polaris-DataTable__Cell  Polaris-DataTable__Cell--firstColumn"> {{number_format($gift->triggered_amount,2)}} $</td>
                      <td class="Polaris-DataTable__Cell  Polaris-DataTable__Cell--firstColumn">
                        @if($gift->active ==1 )
                        <span class="Polaris-Badge Polaris-Badge--statusSuccess">
                          
                          <span class="Polaris-Badge__Content">Published</span>
                        </span>
                        @else
                        <span class="Polaris-Badge Polaris-Badge--statusWarning">
                          
                          <span class="Polaris-Badge__Content">Not Published</span>
                        </span>
                        @endif
                      </td>
                      <td class="Polaris-DataTable__Cell  Polaris-DataTable__Cell--firstColumn" >
                        {{-- <div class="row ">
                          <form action="{{ route ('gift.destroy',$gift->id) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE')}}
                            <button type="submit" class="Polaris-Button Polaris-Button--sizeSlim"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Delete</span></span></button>
                        </form>
                        @if($gift->active ==1 )
                        <form action="{{ route ('gift.state.update',$gift->id) }}" method="POST">
                          @csrf
                          {{ method_field('PATCH')}}
                          <input type="hidden" name="active" value="0">
                          <button type="submit" class=" ml-4 Polaris-Button Polaris-Button--sizeSlim"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Active</span></span></button>
                      </form>
                      @else
                      <form action="{{ route ('gift.state.update',$gift->id) }}" method="POST">
                        @csrf
                        
                        {{ method_field('PATCH')}}
                        <input type="hidden" name="active" value="1">
                        <button type="submit" class="ml-4 Polaris-Button Polaris-Button--sizeSlim"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">DeAactive</span></span></button>
                    </form>
                    @endif

                    
                  <button type="button"  class="ml-4 Polaris-Button Polaris-Button--sizeSlim"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text"><a href="{{ route('gift.edit',$gift->id)}}">Update</a></span></span></button>
                  
                    
                        
                        
                  </div> --}}
                  <div class="Polaris-ButtonGroup Polaris-ButtonGroup--segmented" data-buttongroup-segmented="true">
                    @if($gift->active ==1 )
                        <form action="{{ route ('gift.state.update',$gift->id) }}" method="POST">
                          @csrf
                          {{ method_field('PATCH')}}
                          <input type="hidden" name="active" value="0">
                          
                          <div class="Polaris-ButtonGroup__Item"><button type="submit"  class="Polaris-Button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Active</span></span></button></div>
                      </form>
                      @else
                      <form action="{{ route ('gift.state.update',$gift->id) }}" method="POST">
                        @csrf
                        
                        {{ method_field('PATCH')}}
                        <input type="hidden" name="active" value="1">
                        
                        <div class="Polaris-ButtonGroup__Item"><button type="submit"  class="Polaris-Button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">DeActive</span></span></button></div>
                    </form>
                    @endif
                    {{-- <div class="Polaris-ButtonGroup__Item"><a  class="Polaris-Button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Active</span></span></a></div> --}}
                    <div class="Polaris-ButtonGroup__Item"><a href="{{ route('gift.edit',$gift->id)}}" class="Polaris-Button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">View/Edit</span></span></a></div>
                    <form action="{{ route ('gift.destroy',$gift->id) }}" method="POST">
                      @csrf
                      {{ method_field('DELETE')}}
                    <div class="Polaris-ButtonGroup__Item"><button  class="Polaris-Button" type="submit"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Delete</span></span></button></div>
                    </form>
                </div>

                        </td>
                    </tr>
                    @endforeach
                    {{-- <tr class="Polaris-DataTable__TableRow">
                     <!-- <td class="Polaris-Thumbnail Polaris-Thumbnail--sizeSmall"style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;"><img src="https://burst.shopifycdn.com/photos/black-leather-choker-necklace_373x@2x.jpg" alt="Black choker necklace" class="Polaris-Thumbnail__Image"></td> -->
                     <td class="Polaris-Thumbnail Polaris-Thumbnail--sizeLarge"><img src="https://burst.shopifycdn.com/photos/black-leather-choker-necklace_373x@2x.jpg" alt="Black choker necklace" class="Polaris-Thumbnail__Image"></td>
                    
                      <th class="Polaris-DataTable__Cell  Polaris-DataTable__Cell--firstColumn" scope="row">Free Gift Over 100$</th>
                      <td class="Polaris-DataTable__Cell  Polaris-DataTable__Cell--numeric">free from US $100.00</td>
                      <td class="Polaris-DataTable__Cell  Polaris-DataTable__Cell--numeric"><button type="button" class="Polaris-Button Polaris-Button--sizeSlim"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Disable</span></span></button></td>
                    </tr> --}}
                     
                  </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection