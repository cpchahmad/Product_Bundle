@extends('layout.shopify')
@section('content')
    <form action="{{ route('admin.bundles.create.post') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="bundle_id" value="{{ $bundle->id }}">
    <div class="Polaris-Page-Header Polaris-Page-Header--hasNavigation Polaris-Page-Header--hasActionMenu Polaris-Page-Header--mobileView">
        <div class="Polaris-Page-Header__MainContent">
            <div class="Polaris-Page-Header__TitleActionMenuWrapper">
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="Polaris-Header-Title__TitleAndSubtitleWrapper">
                                <div class="Polaris-Header-Title">
                                    <h1 class="Polaris-DisplayText Polaris-DisplayText--sizeLarge">{{ $bundle->title }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <a target="_blank" href="https://{{ $shop->name }}/admin/products/{{ $bundle->product_id }}" class="Polaris-Button Polaris-Button--primary">
                                    <span class="Polaris-Button__Content">
                                        <span class="Polaris-Button__Text" style="color: white;">Preview</span>
                             </span>
                            </a>

                            <button type="submit" href="{{ route('admin.bundles.create') }}" class="Polaris-Button Polaris-Button--primary">
                                    <span class="Polaris-Button__Content">
                                        <span class="Polaris-Button__Text" style="color: white;">Save</span>
                             </span>
                            </button>
                            <a href="{{ route('admin.bundles.create') }}" class="Polaris-Button Polaris-Button--primary">
                                    <span class="Polaris-Button__Content">
                                        <span class="Polaris-Button__Text" style="color: white;">Add New</span>
                             </span>
                            </a>

                            <a href="{{ route('admin.bundles.delete', $bundle->id) }}" class="Polaris-Button Polaris-Button--primary">
                                    <span class="Polaris-Button__Content">
                                        <span class="Polaris-Button__Text" style="color: white;">Delete</span>
                             </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="Polaris-Page__Content">
            <div class="row">
                <div class="col-md-8">
                    <div class="Polaris-Card">
                        <div class="Polaris-Card__Section">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="Polaris-Labelled__LabelWrapper">
                                            <div class="Polaris-Label"><label class="Polaris-Label__Text">Name of Bundle</label></div>
                                        </div>
                                        <div class="Polaris-Connected">
                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                <div class="Polaris-TextField Polaris-TextField--hasValue">
                                                    <input required class="Polaris-TextField__Input" value="{{ $bundle->title }}" name="title">
                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <div class="Polaris-Labelled__LabelWrapper">
                                            <div class="Polaris-Label">
                                                <label class="Polaris-Label__Text">Actual Price</label></div>
                                        </div>

                                        <div class="Polaris-Connected">
                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                <div class="Polaris-TextField Polaris-TextField--hasValue">
                                                    <div class="Polaris-TextField__Prefix">$</div>
                                                    <input class="Polaris-TextField__Input" type="text" value="{{ $bundle->total_price }}" name="total_price" required>
                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <div class="Polaris-Labelled__LabelWrapper">
                                            <div class="Polaris-Label">
                                                <label  class="Polaris-Label__Text">Discount Type</label></div>
                                        </div>

                                        <div class="Polaris-Select">
                                            <select class="Polaris-Select__Input" aria-invalid="false" name="discount_type">
                                                <option @if($bundle->discount_type == 'percentage') selected @endif value="percentage">Percentage</option>
                                                <option @if($bundle->discount_type == 'fixed') selected @endif value="fixed">Fixed</option>
                                            </select>
                                            <div class="Polaris-Select__Content" aria-hidden="true">
                                                <span class="Polaris-Select__SelectedOption" style="text-transform: capitalize;">{{ $bundle->discount_type }}</span><span class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                          <path d="M13 8l-3-3-3 3h6zm-.1 4L10 14.9 7.1 12h5.8z" fill-rule="evenodd"></path>
                                        </svg></span></span></div>
                                            <div class="Polaris-Select__Backdrop"></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <div class="Polaris-Labelled__LabelWrapper">
                                            <div class="Polaris-Label">
                                                <label  class="Polaris-Label__Text">Discount (Price or Percentage)</label></div>
                                        </div>

                                        <div class="Polaris-Connected">
                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                <div class="Polaris-TextField Polaris-TextField--hasValue">
                                                    <div class="Polaris-TextField__Prefix">$</div>
                                                    <input required class="Polaris-TextField__Input" type="text" value="{{ $bundle->discount }}" name="discount">
                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-12">
                                    <div class="table">
                                        <table class="table" id="productsTable">
                                            <thead>
                                            <tr>
                                                <td></td>
                                                <td>Title</td>
                                                <td>Price</td>
                                                <td>Quantity Per Product</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                                <tr>
                                                    <td>
                                                        <img src="{{ $product->image }}" style="max-width: 50px;">
                                                    </td>
                                                    <td>
                                                        {{ $product->title }}</td>
                                                    <td>${{ number_format($product->price, 2) }}</td>
                                                    <td>
                                                        <div class="Polaris-Connected">
                                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                <div class="Polaris-TextField Polaris-TextField--hasValue">
                                                                    @php
                                                                        $quantity = '';
                                                                    @endphp
                                                                    @if(isset($bundle->has_products))
                                                                        @foreach($bundle->has_products as $p)
                                                                            @if($p->product_id == $product->id)
                                                                            @php
                                                                                $quantity = $p->quantity;
                                                                            @endphp
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                    <input class="Polaris-TextField__Input" name="quantity[]" type="number" value="{{ $quantity }}">
                                                                    <input type="hidden" value="{{ $product->handle }}" name="handle[]">
                                                                    <input type="hidden" value="{{ $product->id }}" name="product[]">
                                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="Polaris-Card">
                        <div class="Polaris-Card__Section">
                            <div class="Polaris-Stack Polaris-Stack--vertical">
                                <div class="Polaris-Stack__Item">
                                    <div><label class="Polaris-Choice" for="published_radio"><span class="Polaris-Choice__Control">
                                                <span class="Polaris-RadioButton">
                                                <input id="published_radio" type="radio" class="Polaris-RadioButton__Input" value="1" name="status" @if($bundle->status == 1) checked @endif>
                                                    <span class="Polaris-RadioButton__Backdrop"></span>
                                                    <span class="Polaris-RadioButton__Icon"></span>
                                                </span>
                                            </span>
                                            <span class="Polaris-Choice__Label">Published</span></label>
                                    </div>
                                </div>
                                <div class="Polaris-Stack__Item" style="margin-top: 0;">
                                    <div>
                                        <label class="Polaris-Choice" for="draft_radio">
                                            <span class="Polaris-Choice__Control">
                                                <span class="Polaris-RadioButton">
                                                    <input id="draft_radio" name="status" @if($bundle->status == 0) checked @endif value="0" type="radio" class="Polaris-RadioButton__Input" aria-describedby="optionalHelpText" value=""><span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span>
                                                </span>
                                            </span>
                                            <span class="Polaris-Choice__Label">Draft</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </form>
@endsection
