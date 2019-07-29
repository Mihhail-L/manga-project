<h2 class="text-white">Categories</h2>
                <button class="btn btn-secondary" data-toggle="collapse" type="button" data-target="#categoriesToggler" aria-expanded="false" id="catCollapse">Show Categories </button>
                <ul class="collapse float-left list-group" id="categoriesToggler">
                    @foreach ($categories as $category)
                        @if($category->mangas->count() > 0)
                            <a href=" {{route('mangashop.category', $category->id)}} " class="reset-text text-white">
                                <li class="categories-btn w-100 list-group-item ">
                                    <div class="mt-1">{{$category->name}}</div>
                                </li>
                            </a>
                        @endif
                    @endforeach
                </ul>
                <hr>
                <h2 class="text-white">Manga</h2>
                <button class="btn btn-secondary" data-toggle="collapse" type="button" data-target="#mangaToggler" aria-expanded="false" id="mangaCollapse">Show Manga </button>
                <ul class="collapse float-left list-group" id="mangaToggler">
                    @foreach ($mangas as $manga)
                        @if($manga->volumes->count() > 0)
                            <a href="{{route('mangashop.manga', $manga->id)}}" class="reset-text text-white">
                                <li class="categories-btn w-100 list-group-item ">
                                    <div class="mt-1">{{$manga->title}}</div>
                                </li>
                            </a>
                        @endif
                    @endforeach
                </ul>
                <hr>
                <h2 class="text-white">Tags</h2>
                <button class="btn btn-secondary" data-toggle="collapse" type="button" data-target="#tagToggler" aria-expanded="false" id="tagCollapse">Show Tags </button>
                <ul class="collapse float-left list-group" id="tagToggler">
                    @foreach ($tags as $tag)
                        @if($tag->mangas->count() > 0)
                            <a href="{{route('mangashop.tag', $tag->id)}}" class="reset-text text-white">
                                <li class="categories-btn w-100 list-group-item ">
                                    <div class="mt-1">{{$tag->name}}</div>
                                </li>
                            </a>
                        @endif
                    @endforeach
                </ul>