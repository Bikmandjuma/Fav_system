 <!-- Logout modal -->
          <div class="modal" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm text-center">
              <div class="modal-content">
                <div class="modal-body">
                  <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h5><b>Logout your account</b> &nbsp;&nbsp;<i class="fa fa-lock"></i> </h5>
                </div>
                <div class="modal-body">
                  <p><i class="fa fa-question-circle"></i>Are you sure , you want to log-off ? <br /></p>
                  <div class="actionsBtns">
                      <input type="hidden" name="${_csrf.parameterName}" value="${_csrf.token}"/>
                      <a href="../Logout.php" class="btn btn-primary" title="logout your account"><i class="fa fa-lock"></i>  Logout</a>
                      <button class="btn btn-danger" data-dismiss="modal" title="cancel to logout"><i class="fa fa-times"></i>  Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <!--end of logout modal-->