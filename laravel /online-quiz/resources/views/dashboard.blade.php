<x-app-layout>
    <div class="row">
        <div class="col-lg-8 mb-6 order-0">
          <div class="card">
            <div class="d-flex align-items-start row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary mb-3">Welcome {{ Auth::user()->name ?? 'User' }}! 🎉</h5>
                  <p class="mb-6">
                    You have successfully logged in to your new Sneat dashboard.<br />Customize it to fit your needs!
                  </p>
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-6">
                  <img src="{{ asset('assets/img/illustrations/man-with-laptop.png') }}" height="175" alt="View Badge User" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
              <div class="col-lg-6 col-md-12 col-6 mb-6">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                      <div class="avatar flex-shrink-0">
                        <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded" />
                      </div>
                    </div>
                    <p class="mb-1">Example Metric</p>
                    <h4 class="card-title mb-3">1,248</h4>
                    <small class="text-success fw-medium"><i class="icon-base bx bx-up-arrow-alt"></i> +72.80%</small>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 col-6 mb-6">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                      <div class="avatar flex-shrink-0">
                        <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="wallet info" class="rounded" />
                      </div>
                    </div>
                    <p class="mb-1">Status</p>
                    <h4 class="card-title mb-3">Active</h4>
                    <small class="text-success fw-medium"><i class="icon-base bx bx-check"></i> Connected</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</x-app-layout>
