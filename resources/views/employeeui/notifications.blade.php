@extends('layouts.ui')
@section('content')

<main role="main" class="main-content mt-4">
  <div class="container-fluid">
    <div class="row">

    <div class="col-sm-12">
    <div class="m-portlet m-portlet--full-height">
        <div class="m-portlet__head" style="background: #181144; background-size: cover;">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text" style="color:white;">Important Links &amp; Notifications</h3>
                </div>
            </div>
        </div>
        <div>
            <div class="m-scrollable mCustomScrollbar _mCS_2 mCS-autoHide" data-scrollable="true" data-max-height="540" style="max-height: 540px; height: 540px; position: relative; overflow: visible;">
                <div id="mCSB_2" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0">
                    <div id="mCSB_2_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                        <div class="m-portlet__body pb-0">
                            <div id="wnImportantLink">
                                <div id="NotificationLinkBox1_UpdatePanel">
                                    <div id="lyrImportantLink" class="col-xl-12">
                                        <span id="NotificationLinkBox1_lblNotError" class="error"></span>
                                        <div class="m-timeline-3">
                                            <div class="m-timeline-3__items">
                                                @if($notifications->isEmpty())
                                                    <div class="m-timeline-3__item">
                                                        <div class="m-timeline-3__item-desc">
                                                            No notifications to watch.
                                                        </div>
                                                    </div>
                                                @else
                                                    @foreach($notifications as $notification)
                                                        <div class="m-timeline-3__item m-timeline-3__item--success">
                                                            <span class="m-timeline-3__item-time m--regular-font-size-">
                                                                {{ date('F j, Y', strtotime($notification->date)) }}
                                                            </span>
                                                            <div class="m-timeline-3__item-desc">
                                                                <span class="m-timeline-3__item-user-name">

                                                                    <a id="{{ $notification->id }}" class="newstext m--font-bolder" href="{{ $notification->link }}" target="_blank">{{ $notification->heading }}</a>
                                                                    <br>
                                                                    <a id="{{ $notification->id }}" class="newstext m--font-bolder" href="{{ $notification->link }}" target="_blank">{{ $notification->description }}</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical" style="display: block;">
                    <div class="mCSB_draggerContainer">
                        <div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; display: block; height: 240px; max-height: 520px; top: 0px;">
                            <div class="mCSB_dragger_bar" style="line-height: 50px;"></div>
                        </div>
                        <div class="mCSB_draggerRail"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    </div>
  </div> <!-- .container-fluid -->
</main> <!-- main -->

@endsection


<style scoped>
  .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title .m-portlet__head-text {
    display: table-cell;
    vertical-align: middle;
    font-size: 1.3rem;
    font-weight: 500;
    font-family: Roboto;
  }

  .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title {
    display: table;
    table-layout: fixed;
    height: 100%;
  }

  .m-portlet .m-portlet__head .m-portlet__head-caption {
    display: table-cell;
    vertical-align: middle;
    text-align: left;
  }

  .m-portlet .m-portlet__head {
    display: table;
    padding: 0;
    width: 100%;
    padding: 0 2.2rem;
    height: 5.1rem;
  }

  .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title .m-portlet__head-text {
    display: table-cell;
    vertical-align: middle;
    font-size: 1.3rem;
    font-weight: 500;
    font-family: Roboto;
  }

  .m-portlet .m-portlet__body {
    padding: 2.2rem 2.2rem;
  }

  .mCSB_container {
    overflow: hidden;
    width: auto;
    height: auto;
  }

  .mCustomScrollBox {
    position: relative;
    overflow-y: scroll;
    height: 100%;
    /* max-height: 100% */
    max-width: 100%;
    outline: none;
    direction: ltr;

  }

  .m-portlet .m-portlet__body {
    color: black;
  }

  .m-timeline-3 .m-timeline-3__item {
    disply: table;
    margin-bottom: 1rem;
    position: relative;
  }

  .m-timeline-3__item.m-timeline-3__item--success:before {
    background: #34bfa3;
  }

  .m-timeline-3 .m-timeline-3__item:before {
    position: absolute;
    display: block;
    width: 0.28rem;
    -webkit-border-radius: 0.3rem;
    -moz-border-radius: 0.3rem;
    -ms-border-radius: 0.3rem;
    -o-border-radius: 0.3rem;
    border-radius: 0.3rem;
    height: 70%;
    left: 5.1rem;
    top: 0.46rem;
    content: "";
  }

  .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-time {
    display: table-cell;
    vertical-align: top;
    padding-top: 0.6rem;
    font-weight: 500;
    font-size: 16px;
    position: absolute;
    text-align: right;
    width: 3.57rem;
  }

  .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-desc {
    display: table-cell;
    width: 100%;
    vertical-align: top;
    font-size: 1rem;
    padding-left: 7rem;
  }

  .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-desc {
    display: table-cell;
    width: 100%;
    vertical-align: top;
    font-size: 1rem;
    padding-left: 7rem;
  }

  .m-link.m-link--metal {
    color: #c4c5d6;
  }

  .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-desc .m-timeline-3__item-user-name .m-timeline-3__item-link {
    font-size: 0.85rem;
    text-decoration: none;
  }

  .newstext {
    color: black !important;
    cursor: pointer;
  }
  /* Modify the scrollbar styles */
.mCustomScrollBox::-webkit-scrollbar {
  width: 6px;
}

/* Track */
.mCustomScrollBox::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
.mCustomScrollBox::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
.mCustomScrollBox::-webkit-scrollbar-thumb:hover {
  background: #555;
}
.btn.btn-secondary {
    background: white;
    border-color: #ebedf2;
    color: #212529;
}
.btn-secondary {
    color: #212529;
    background-color: #ebedf2;
    border-color: #ebedf2;
        font-size: 14px;
    padding: 10px;
    border-radius: 15px;
}
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.65rem 1rem;
    font-size: 1rem;
    line-height: 1.25;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

</style>
