<style scoped>
.action-link {
  cursor: pointer;
}

.m-b-none {
  margin-bottom: 0;
}
</style>

<template>
  <div>
    <div v-if="tokens.length > 0">
      <div class="panel panel-default">
        <div class="panel-heading">Authorized Applications</div>

        <div class="panel-body">
          <!-- Authorized Tokens -->
          <table class="table table-borderless m-b-none">
            <thead>
            <tr>
              <th>Name</th>
              <th>Scopes</th>
              <th></th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="token in tokens">
              <!-- Client Name -->
              <td style="vertical-align: middle;">
                {{ token.client.name }}
              </td>

              <!-- Scopes -->
              <td style="vertical-align: middle;">
                                    <span v-if="token.scopes.length > 0">
                                        {{ token.scopes.join(', ') }}
                                    </span>
              </td>

              <!-- Revoke Button -->
              <td style="vertical-align: middle;">
                <a class="action-link text-danger" @click="revoke(token)">
                  Revoke
                </a>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      tokens: []
    }
  },
  mounted: function () {
    this.prepareComponent()
  },
  methods: {
    prepareComponent: function () {
      this.getTokens()
    },
    /**
     * Get all of the authorized tokens for the user.
     */
    getTokens: function () {
      this.$http.get('/oauth/tokens')
      .then(response => {
        this.tokens = response.data
      })
    },
    /**
     * Revoke the given token.
     */
    revoke (token) {
      this.$http.delete('/oauth/tokens/' + token.id)
      .then((response) => {
        this.getTokens()
      })
    }
  }
}
</script>
