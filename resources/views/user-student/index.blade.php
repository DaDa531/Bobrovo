@extends('layouts.master-student')

@section('title')
    Bobrovo - žiak
@endsection

@section('content')
<div class="container">
    <div class="row">

        <!-- Main content -->
        <div class="col-md-12">
            <section>
                <h1>Vitaj Jožko Mrkvička</h1>

                <p>Posted on <time datetime="2017-05-14">14 May</time> by <a href="#" rel="author">Joe Bloggs</a></p>

                <p>Welcome to widget2, a free CSS3 &amp; HTML5 responsive web template from <a href="https://zypopwebtemplates.com/" title="ZyPOP">ZyPOP</a>. This template is completely <strong>free</strong> to use permitting a link remains back to  <a href="https://zypopwebtemplates.com/" title="ZyPOP">https://zypopwebtemplates.com/</a>.</p>

                <p> Should you wish to use this template unbranded you can buy a template license from our website for 8.00 GBP, this will allow you remove all branding related to our site, for more information about this see below.</p>

                <p>This template has been tested in:</p>

                <ul>
                    <li>Firefox</li>
                    <li>IE / Edge</li>
                    <li>Chrome</li>
                    <li>Safari</li>
                    <li>iOS / Android</li>
                </ul>


                <a href="#" class="btn btn-primary">Read more</a>
                <a href="#" class="btn btn-secondary">Comments</a>

                <p>&nbsp;</p>
            </section>


            <!-- Example pagination Bootstrap component -->
            <nav>
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>
@endsection