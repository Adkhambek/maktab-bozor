
<nav class="sidebar sidebar-bunker">
            <div class="sidebar-header">
                <!--<a href="index.html" class="logo"><span>bd</span>task</a>-->
                <a href="index" class="logo"><span class="text-primary">Maktab </span><span class="text-light">Bozor</span>  </a>
            </div>


            <div class="sidebar-body">
                <nav class="sidebar-nav">
                    <ul class="metismenu">
                        <li class="nav-label">Main Menu</li>
                        <li class="<?php if ($page == 'dash') {echo 'mm-active';}?>">
                            <a href="index">
                                <i class="typcn typcn-home-outline mr-2"></i>
                                Dashboard
                            </a>

                        </li>

                        <li class="<?php if ($page == 'orders') {echo 'mm-active';}?>">
                            <a href="orders">
                                <i class="typcn typcn-shopping-cart mr-2"></i>
                                Orders Table
                            </a>

                        </li>
                        <li class="<?php if ($page == 'products') {echo 'mm-active';}?>">
                            <a href="products">
                                <i class="typcn typcn-th-list-outline mr-2"></i>
                                Products Table
                            </a>

                        </li>


                        <li class="nav-label">Forms</li>

                        <li class="<?php if ($page == 'category') {echo 'mm-active';}?>">
                            <a href="category">
                                <i class="typcn typcn-folder-add mr-2"></i>
                                Category Adding
                            </a>

                        </li>
                        <li class="<?php if ($page == 'product_adding') {echo 'mm-active';}?>">
                            <a href="adding_product">
                                <i class="typcn typcn-document-add mr-2"></i>
                                Product Adding
                            </a>

                        </li>

                        <li class="nav-label">Extra</li>
                        <li class="<?php if ($page == 'users') {echo 'mm-active';}?>">
                            <a href="users">
                                <i class="typcn typcn-user mr-2"></i>
                                Users
                            </a>

                        </li>



                    </ul>
                </nav>
            </div><!-- sidebar-body -->
        </nav>
        <div class="overlay"></div>