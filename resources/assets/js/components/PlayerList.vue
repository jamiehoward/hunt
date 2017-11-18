<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h4>Players <span class="badge">({{players.length}})</span></h4>

                <ul class="list-unstyled">
                    <li v-for="player in players">
                        <a href="#" data-toggle="tooltip" data-placement="top">{{player.name}}</a>
                    </li>
                </ul>
            
                <div class="text-center">
                    <p class="text-muted" v-if="players.length == 0">No players yet. Add one!</p>
                </div>

                <h4>Add a player</h4>
                <form class="form" v-on:submit.prevent="savePlayer">
                    <div class="form-group">
                        <input type="text" placeholder="name" class="form-control form-control-sm" v-model="name" required/>
                    </div>

                    <div class="form-group">
                        <input type="email" placeholder="email" class="form-control form-control-sm" v-model="email" required/>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Save"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props : ['campaign'],
        data : function() {
            return {
                players : [],
                name : '',
                email : ''
            }
        },
        methods: {
            getPlayers: function() {
                axios.get('/api/campaigns/' + this.campaign + '/players')
                    .then(response => this.players = response.data);    
            },
            savePlayer : function () {
                const self = this;

                axios.post('/api/campaigns/' + this.campaign + '/players', { name: this.name, email: this.email })
                  .then(function(response){
                    self.getPlayers();
                    
                    self.name = self.email = '';

                    swal("Player successfully created!", {
                      icon: 'success',
                      button: false,
                      timer: 1500
                    });

                  });
            },
        },
        mounted() {
            this.getPlayers();
        }
    }
</script>
