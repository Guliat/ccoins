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
  <script>
    document.addEventListener('DOMContentLoaded', () => {

// Get all "navbar-burger" elements
const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

// Check if there are any navbar burgers
if ($navbarBurgers.length > 0) {

  // Add a click event on each of them
  $navbarBurgers.forEach( el => {
    el.addEventListener('click', () => {

      // Get the target from the "data-target" attribute
      const target = el.dataset.target;
      const $target = document.getElementById(target);

      // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
      el.classList.toggle('is-active');
      $target.classList.toggle('is-active');

    });
  });
}

}); 
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