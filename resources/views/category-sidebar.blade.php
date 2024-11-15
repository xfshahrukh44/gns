<ul>
    @foreach($categories as $category)
        <li {!! ($category->children->count() > 0) ? 'class="shop_info"' : '' !!}>
            <a class="a_category" data-id="{{$category->id}}" href="#" {!! is_array($category_tree_ids) && in_array($category->id, $category_tree_ids) ? 'style="color: red;"' : '' !!}>{{$category->name}}</a>

            @if ($category->children->count() > 0)
                <i class="fa-solid fa-angle-up {!! is_array($category_tree_ids) && in_array($category_2->id, $category_tree_ids) ? 'clicked' : '' !!}"></i>
                <div class="shop_show" style="display: {!! is_array($category_tree_ids) && in_array($category->id, $category_tree_ids) ? 'block' : 'none' !!};">
                    <ul>
                        @foreach($category->children as $category_2)
                            <li {!! ($category_2->children->count() > 0) ? 'class="shop_info"' : '' !!}>
                                <a class="a_category" data-id="{{$category_2->id}}" href="#" {!! is_array($category_tree_ids) && in_array($category_2->id, $category_tree_ids) ? 'style="color: red;"' : '' !!}>{{$category_2->name}}</a>

                                @if ($category_2->children->count() > 0)
                                    <i class="fa-solid fa-angle-up {!! is_array($category_tree_ids) && in_array($category_2->id, $category_tree_ids) ? 'clicked' : '' !!}"></i>
                                    <div class="shop_show" style="display: {!! is_array($category_tree_ids) && in_array($category_2->id, $category_tree_ids) ? 'block' : 'none' !!};">
                                        <ul>
                                            @foreach($category_2->children as $category_3)
                                                <li {!! ($category_3->children->count() > 0) ? 'class="shop_info"' : '' !!}>
                                                    <a class="a_category" data-id="{{$category_3->id}}" href="#" {!! is_array($category_tree_ids) && in_array($category_3->id, $category_tree_ids) ? 'style="color: red;"' : '' !!}>{{$category_3->name}}</a>

                                                    @if ($category_3->children->count() > 0)
                                                        <i class="fa-solid fa-angle-up {!! is_array($category_tree_ids) && in_array($category_3->id, $category_tree_ids) ? 'clicked' : '' !!}"></i>
                                                        <div class="shop_show" style="display: {!! is_array($category_tree_ids) && in_array($category_3->id, $category_tree_ids) ? 'block' : 'none' !!};">
                                                            <ul>
                                                                @foreach($category_3->children as $category_4)
                                                                    <li {!! ($category_4->children->count() > 0) ? 'class="shop_info"' : '' !!}>
                                                                        <a class="a_category" data-id="{{$category_4->id}}" href="#" {!! is_array($category_tree_ids) && in_array($category_4->id, $category_tree_ids) ? 'style="color: red;"' : '' !!}>{{$category_4->name}}</a>

                                                                        @if ($category_4->children->count() > 0)
                                                                            <i class="fa-solid fa-angle-up {!! is_array($category_tree_ids) && in_array($category_4->id, $category_tree_ids) ? 'clicked' : '' !!}"></i>
                                                                            <div class="shop_show" style="display: {!! is_array($category_tree_ids) && in_array($category_4->id, $category_tree_ids) ? 'block' : 'none' !!};">
                                                                                <ul>
                                                                                    @foreach($category_4->children as $category_5)
                                                                                        <li {!! ($category_5->children->count() > 0) ? 'class="shop_info"' : '' !!}>
                                                                                            <a class="a_category" data-id="{{$category_5->id}}" href="#" {!! is_array($category_tree_ids) && in_array($category_5->id, $category_tree_ids) ? 'style="color: red;"' : '' !!}>{{$category_5->name}}</a>

                                                                                            @if ($category_5->children->count() > 0)
                                                                                                <i class="fa-solid fa-angle-up {!! in_array($category_5->id, $category_tree_ids) ? 'clicked' : '' !!}"></i>
                                                                                                <div class="shop_show" style="display: {!! is_array($category_tree_ids) && in_array($category_5->id, $category_tree_ids) ? 'block' : 'none' !!};">
                                                                                                    <ul>
                                                                                                        @foreach($category_5->children as $category_6)
                                                                                                            <li {!! ($category_6->children->count() > 0) ? 'class="shop_info"' : '' !!}>
                                                                                                                <a class="a_category" data-id="{{$category_6->id}}" href="#" {!! is_array($category_tree_ids) && in_array($category_6->id, $category_tree_ids) ? 'style="color: red;"' : '' !!}>{{$category_6->name}}</a>
                                                                                                            </li>
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                </div>
                                                                                            @endif
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </li>
    @endforeach
</ul>