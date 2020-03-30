@extends('layout.shopify')
@section('content')

            <div class="Polaris-Page-Header Polaris-Page-Header--hasNavigation Polaris-Page-Header--hasActionMenu Polaris-Page-Header--mobileView">
                <div class="Polaris-Page-Header__MainContent">
                    <div class="Polaris-Page-Header__TitleActionMenuWrapper">
                        <div>
                            <div class="Polaris-Header-Title__TitleAndSubtitleWrapper">
                                <div class="Polaris-Header-Title">
                                    <h1 class="Polaris-DisplayText Polaris-DisplayText--sizeLarge">Products</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                    <div class="Polaris-Page__Content">
                        <div class="Polaris-Card">
                            <div class="">
                                <div class="Polaris-DataTable">
                                    <div class="Polaris-DataTable__ScrollContainer">
                                        <table class="Polaris-DataTable__Table">
                                            <thead>
                                            <tr>
                                                <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Image</th>
                                                <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Product</th>
                                                <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Price</th>
                                                <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                            <tr class="Polaris-DataTable__TableRow">
                                                <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                                     <img src="{{ $product->image }}" style="max-height: 70px;">
                                                </th>
                                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                                    {{ $product->title }}
                                                </td>
                                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                                    ${{ number_format($product->price, 2) }}
                                                </td>
                                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                                    <button type="button" class="Polaris-Button Polaris-Button--primary">
                                    <span class="Polaris-Button__Content">
                                        <span class="Polaris-Button__Text">View</span>
                                    </span>
                                                    </button>
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
    <style>
        .Polaris-DataTable__Cell--verticalAlignTop {
            text-align: left;
        }
    </style>
@endsection
