                    <div class="row">

                            <!-- Profile Info and Notifications -->
                            <div class="col-md-6 col-sm-8 clearfix">

                                    <ul class="user-info pull-left pull-none-xsm">



                                    </ul>

                            </div>


                            <!-- Raw Links -->
                            <div class="col-md-6 col-sm-4 clearfix hidden-xs">

                                    <ul class="list-inline links-list pull-right">

                                            <li>
                                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                            Log Out <i class="entypo-logout right"></i>
                                                    </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                            </li>
                                    </ul>

                            </div>

                    </div>