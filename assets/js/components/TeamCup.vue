<template>
  <div class="row">
    <div v-for="cup in cups" class="col-12">
      <div class="champTableTitle">
        {{ cup.season }}
      </div>
      <div v-for="match in cup.matches" class="row odd">
        <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 match-stadia">{{ match.stadia }}</div>
        <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 match-date">{{ match.data }}</div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 match-teams">{{ match.team }} - {{ match.team2 }}</div>
        <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 match-score">{{ match.score }}</div>
        <div class="col-xs-12 col-sm-5 col-md-6 col-lg-6">{{ match.bomb }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TeamCup",
  props: {
    cups: {
      type: Array,
      required: true
    }
  },
}
</script>

<style scoped lang="scss">
@media (min-width: 992px) {
  .odd {
    .match-stadia {
      width: 10.33333333%;
    }
    .match-date {
      width: 6.33333333%;
    }
  }
}
</style>