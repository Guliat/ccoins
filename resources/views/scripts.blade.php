<script>
  new Vue({
    el: '#toasts',
    methods: {
      updated() {
        this.$buefy.toast.open({
          duration: 1000,
          message: '<i class="fas fa-check"></i> Updated!',
          position: 'is-top',
          type: 'is-info'
        })
      },
      added() {
        this.$buefy.toast.open({
          duration: 1000,
          message: '<i class="fas fa-check"></i> Added!',
          position: 'is-top',
          type: 'is-success'
        })
      },
      deleted() {
        this.$buefy.toast.open({
          duration: 1000,
          message: '<i class="fas fa-check"></i> Deleted!',
          position: 'is-top',
          type: 'is-danger'
        })
      },
      undeleted() {
        this.$buefy.toast.open({
          duration: 1000,
          message: '<i class="fas fa-check"></i> Undeleted!',
          position: 'is-top',
          type: 'is-warning'
        })
      }
    }
  })
  </script>
  <?php
    if(Session::has('updated')) { 
      echo '<script> document.getElementById("updated_toast").click(); </script>';
    }
    if(Session::has('added')) { 
      echo '<script> document.getElementById("added_toast").click(); </script>';
    }
    if(Session::has('deleted')) { 
      echo '<script> document.getElementById("deleted_toast").click(); </script>';
    }
    if(Session::has('undeleted')) { 
      echo '<script> document.getElementById("undeleted_toast").click(); </script>';
    }
  ?>