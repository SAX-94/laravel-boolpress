<template>
  <footer class="border-top py-5">
    <div class="container px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#!">
                <span class="fa-stack fa-lg">
                  <i class="fa-brands fa-twitter fa-circle "></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#!">
                <span class="fa-stack fa-lg">
                  <i class="fa-brands fa-facebook fa-circle "></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#!">
                <span class="fa-stack fa-lg">
                  <i class="fa-brands fa-github fa-circle "></i>
                </span>
              </a>
            </li>
          </ul>
          <div class="small text-center text-muted fst-italic">Copyright © Your Website 2022</div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {

}
</script>

<style lang="scss">
.list-inline-item {
  .fa-stack {
    background-color: var(--color-dark);
    padding: .5rem;
    height: 2.5em;
    border-radius: 50%;
    transition: background-color .3s;

    i {
      font-size: 24px;
      color: white;
    }

    &:hover {
        background-color: var(--color-primary);
      }
  }
}
</style>