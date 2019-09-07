<template>
  <div class="container" id="Header">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-widget widget-user bg-secondary" id="Header">
          <div class="widget-user-header bg-info-active">
            <h5 class="widget-user-desc text-white">{{form.type}}</h5>
          </div>
          <div class="widget-user-image mx-auto d-block">
            <img
              class="rounded-circle"
              :src="getProfilePhoto()"
              name="photo"
              id="photo"
              alt="User Avatar"
            />
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header">Telephone Number</h5>
                  <div v-if="form.Telephone==null">
                    <span class="description-text text-white">Not available</span>
                  </div>
                  <div v-else>
                    <span class="description-text text-white">{{form.Telephone}}</span>
                  </div>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header">NIC</h5>

                  <div v-if="form.NIC==null">
                    <span class="description-text text-white">Not available</span>
                  </div>
                  <div v-else>
                    <span class="description-text text-white">{{form.NIC}}</span>
                  </div>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header">Email</h5>
                  <span class="description-text text-white">{{form.email}}</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  href="#settings"
                  data-toggle="tab"
                >Update General Infomation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#password" data-toggle="tab">Change Password</a>
              </li>
            </ul>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-10 control-label">Name</label>

                    <div class="col-sm-10">
                      <input
                        v-model="form.name"
                        type="text"
                        class="form-control"
                        id="name"
                        placeholder="Name"
                        :class="{'is-invalid':form.errors.has('name') }"
                      />
                      <has-error :form="form" field="name"></has-error>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-10 control-label">Email</label>

                    <div class="col-sm-10">
                      <input
                        v-model="form.email"
                        type="email"
                        class="form-control"
                        id="email"
                        placeholder="Email"
                        :class="{'is-invalid':form.errors.has('email') }"
                      />

                      <has-error :form="form" field="email"></has-error>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-10 control-label">Telephone Number</label>

                    <div class="col-sm-10">
                      <input
                        v-model="form.Telephone"
                        type="number"
                        class="form-control"
                        id="Telephone"
                        placeholder="Telephone Number"
                        :class="{'is-invalid':form.errors.has('Telephone') }"
                      />
                      <has-error :form="form" field="Telephone"></has-error>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-10 control-label">Upload Profile Picture</label>

                    <div class="col-sm-10">
                      <input
                        type="file"
                        @change="updateProfilePic"
                        class="form-control"
                        name="photo"
                        id="profilePic"
                      />
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10" id="app">
                      <button
                        @click.prevent="updateInfo"
                        type="submit"
                        class="btn btn-primary"
                      >Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="password">
                <form class="form-horizontal">
                  <!--old password -->
                  <div class="form-group">
                    <label class="col-sm-10 control-label">Enter your Current Password</label>

                    <div class="col-sm-10">
                      <input
                        type="password"
                         v-model="form.oldPassword"
                        class="form-control"
                        id="oldPassword"
                        :class="{'is-invalid':form.errors.has('oldPassword') }"
                      />
                      <has-error :form="form" field="oldPassword"></has-error>
                      <has-error :form="form" field="error"></has-error>
                    </div>
                  </div>
                  <!--new password -->
                  <div class="form-group">
                    <label class="col-sm-10 control-label">Enter your New Password</label>

                    <div class="col-sm-10">
                      <input
                        type="password"
                        v-model="form.newPassword"
                        class="form-control"
                        id="newPassword"
                        :class="{'is-invalid':form.errors.has('newPassword') }"
                      />
                      <has-error :form="form" field="newPassword"></has-error>
                    </div>
                  </div>
                  <!--confirm password -->
                  <div class="form-group">
                    <label class="col-sm-10 control-label">Enter your New Password</label>

                    <div class="col-sm-10">
                      <input
                        type="password"
                        class="form-control"
                         v-model="form.confirmPassword"
                        id="confirmPassword"
                        :class="{'is-invalid':form.errors.has('confirmPassword') }"
                      />
                      <has-error :form="form" field="confirmPassword"></has-error>
                    </div>
                  </div>

                  <!--button -->
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10" id="app">
                      <button
                        @click.prevent="updatePassword"
                        type="submit"
                        class="btn btn-primary"
                      >Change Password</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    photo: "";
    
    return {
      form: new Form({
        name: "",
        Telephone: "",
        email: "",
        photo: "",
        type: "",
        NIC: "",
        oldPassword: "",
        newPassword: "",
        confirmPassword: "",
        password:"",
        error:'',
       
        
      })
    };
  },
  created() {
    axios.get("api/profile").then(({ data }) => this.form.fill(data));
  },
  methods: {
    getProfilePhoto() {
      let photo = this.form.photo;
      if (this.form.photo) {
        let prefix = this.form.photo.match(/\//) ? "" : "/img/profile/";
        return prefix + this.form.photo;
      } else {
        photo = "img/profiles/" + this.form.photo;
      }
      return photo;
    },

    updateInfo() {
      this.form
        .put("api/profile/")
        .then(() => {
          Swal.fire({
            type: "success",
            title: "Updated successfully"
          });
        })
        .catch(() => {
          Swal.fire({
            type: "error",
            title: "Invalid input ",
            text: "Update falier"
          });
        });
         
        
    },
    updateProfilePic(e) {
      let file = e.target.files[0];
      console.log(file);
      let reader = new FileReader();

      if (file["size"] < 2111775) {
        reader.onloadend = file => {
          this.form.photo = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        Swal.fire({
          type: "error",
          title: "Large File ",
          text: "You are uploading large file"
        });
      }
    },
    updatePassword() {
      this.form
        .put("api/profileChangePassword/")
        .then(() => {
          Swal.fire({
            type: "success",
            title: "Updated successfully"
          });
        })
        .catch(() => {
          Swal.fire({
            type: "error",
            title: "Invalid password",
            text: "Enter correct password",
            
          });
        });
       
    }
  }
};
</script>

<style>
.widget-user-header {
  background-position: center center;
  background-size: cover;
  height: 0vh;
  background-image: cover;
}

#profilePic {
  background-color: cornflowerblue;
}
#photo {
  width: 250px;
  height: 250px;
}
.widget-user-header {
  color: black;
}
h5 {
  color: black;
}
#photo {
  max-width: 100%;
  max-height: 100%;
}
</style>
