<template>
  <div class="team-champ">
    <table class="shipTable showTeam">
      <thead>
      <tr class="shipTableTitle">
        <th>&nbsp;</th>
        <th class="winsTable">И</th>
        <th class="winsTable">В</th>
        <th class="winsTable">Н</th>
        <th class="winsTable">П</th>
        <th class="goalsTable">M</th>
        <th class="winsTable">О</th>
      </tr>
      </thead>
      <tbody>
      <tr class="odd" v-for="champ in shiptables">
        <td class="player-position team-champ-season">{{ champ.season }}</td>
        <td>{{ champ.wins+champ.nich+champ.porazh }}</td>
        <td>{{ champ.wins }}</td>
        <td>{{ champ.nich }}</td>
        <td>{{ champ.porazh }}</td>
        <td>{{ champ.mz }}-{{ champ.mp }}</td>
        <td class="table-score">{{ champ.score }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "TeamChamp",
  props: {
    shiptables: {
      type: Array,
      required: true
    }
  },
}
</script>

<style scoped>
.team-champ {
  min-width: 330px;
}
.team-champ-season {
  width: 60px;
}
</style>