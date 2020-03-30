@extends('layout.shopify')
@section('content')

    <div class="Polaris-Page-Header Polaris-Page-Header--hasNavigation Polaris-Page-Header--hasActionMenu Polaris-Page-Header--mobileView">
        <div class="Polaris-Page-Header__MainContent">
            <div class="Polaris-Page-Header__TitleActionMenuWrapper">
                <div>
                    <div class="row">
                        <div class="col-md-6">
                    <div class="Polaris-Header-Title__TitleAndSubtitleWrapper">
                        <div class="Polaris-Header-Title">
                            <h1 class="Polaris-DisplayText Polaris-DisplayText--sizeLarge">Dashboard</h1>
                        </div>
                    </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('admin.products.sync') }}" class="Polaris-Button Polaris-Button--primary">
                                    <span class="Polaris-Button__Content">
                                        <span class="Polaris-Button__Text" style="color: white;">Sync Products</span>
                                    </span>
                            </a>

                            <a href="{{ route('admin.bundles.create') }}" class="Polaris-Button Polaris-Button--primary">
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

            @if(count($bundles) >= 1)
            <div class="Polaris-Card__Section">
                <div class="Polaris-Stack Polaris-Stack--alignmentCenter">
                    <div class="Polaris-Stack__Item Polaris-Stack__Item--fill">
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>Title</b></p>
                            </div>

                            <div class="col-md-2">
                                <b>Discount Type</b>
                            </div>

                            <div class="col-md-2">
                                <b>Discount Value</b>
                            </div>

                            <div class="col-md-2">
                                <b> Status</b>
                            </div>

                        </div>
                    </div>
                    <div class="Polaris-Stack__Item">
                        <div class="Polaris-ButtonGroup Polaris-ButtonGroup--segmented" style="opacity: 0" data-buttongroup-segmented="true">
                            <div class="Polaris-ButtonGroup__Item"><button type="button" class="Polaris-Button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">View</span></span></button></div>
                            <div class="Polaris-ButtonGroup__Item"><button type="button" class="Polaris-Button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Delete</span></span></button></div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($bundles as $bundle)
            <div class="Polaris-Card__Section">
                <div class="Polaris-Stack Polaris-Stack--alignmentCenter">
                    <div class="Polaris-Stack__Item Polaris-Stack__Item--fill">
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>{{ $bundle->title }}</b></p>
                            </div>

                            <div class="col-md-2">
                            @if($bundle->discount_type == 'percentage')
                                <span class="Polaris-Badge Polaris-Badge--statusInfo"><span class="Polaris-VisuallyHidden">Percentage</span><span class="Polaris-Badge__Content">Percentage</span></span>
                                @else
                                    <span class="Polaris-Badge Polaris-Badge--statusAttention"><span class="Polaris-VisuallyHidden">Fixed</span><span class="Polaris-Badge__Content">Fixed</span></span>
                                @endif

                            </div>

                            <div class="col-md-2">
                                @if($bundle->discount_type == 'percentage')
                                        {{ $bundle->discount }}%
                                    @else
                                    ${{ number_format($bundle->discount, 2) }}
                                @endif
                            </div>

                            <div class="col-md-2">
                                @if($bundle->status == 1)
                                    <span class="Polaris-Badge Polaris-Badge--statusInfo"><span class="Polaris-VisuallyHidden">Percentage</span><span class="Polaris-Badge__Content">Published</span></span>
                                @else
                                    <span class="Polaris-Badge Polaris-Badge--statusAttention"><span class="Polaris-VisuallyHidden">Fixed</span><span class="Polaris-Badge__Content">Draft</span></span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="Polaris-Stack__Item">
                        <div class="Polaris-ButtonGroup Polaris-ButtonGroup--segmented" data-buttongroup-segmented="true">
                            <div class="Polaris-ButtonGroup__Item"><a target="_blank" href="https://{{ $shop->name }}/admin/products/{{ $bundle->product_id }}" class="Polaris-Button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Preview</span></span></a></div>
                            <div class="Polaris-ButtonGroup__Item"><a href="{{ route('admin.bundles.view', $bundle->id) }}" class="Polaris-Button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">View/Edit</span></span></a></div>
                            <div class="Polaris-ButtonGroup__Item"><a href="{{ route('admin.bundles.delete', $bundle->id) }}" class="Polaris-Button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Delete</span></span></a></div>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
            @else

                <div class="Polaris-Stack Polaris-Stack--alignmentCenter" style="margin-top:15px;">
                    <div class="Polaris-Stack__Item Polaris-Stack__Item--fill text-center" style="margin-bottom: 15px;">
                            <h2 class="h2">No bundle product created yet.</h2>
                    </div>
                </div>

            @endif
        </div>
    </div>

@endsection
