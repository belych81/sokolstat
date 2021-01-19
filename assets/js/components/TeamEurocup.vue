<template>
  <div class="row">
    <div v-for="eurocup in eurocups" class="col-12">
      <div class="champTableTitle">
        {{ eurocup.season }}
      </div>
      <div v-for="match in eurocup.matches" class="row odd">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">{{ match.turnir }}</div>
        <div class="col-xs-9 col-sm-2 col-md-1 col-lg-1">{{ match.stadia }}</div>
        <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1">{{ match.data }}</div>
        <div class="col-xs-9 col-sm-7 col-md-3 col-lg-3 match-teams">{{ match.team }} - {{ match.team2 }}</div>
        <div class="col-xs-3 col-sm-1 col-md-1 col-lg-1 match-score">{{ match.score }}</div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 match-bomb">{{ match.bomb }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TeamEurocup",
  props: {
    eurocups: {
      type: Array,
      required: true
    }
  },
}
</script>

<style scoped lang="scss">
@media (max-width: 991px) {
  .match-bomb {
    text-align: right;
  }
}
</style>