<template>
   <div class="container">
       <div class="mt-5">
           <div class="card">
               <div class="card-header text-center">Information</div>
               <div class="card-body">
                   <div class="alert alert-success" role="alert" v-if="alert">
                       {{alert}}
                   </div>
                   <form>
                       <div class="form-group row align-items-center">
                           <label class="col-sm-2 mb-0">Name</label>
                           <div class="col-sm-10">
                               <input type="text" class="form-control" v-model="basicInfo.name">
                               <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                           </div>
                       </div>
                       <div class="form-group row align-items-center">
                           <label class="col-sm-2 mb-0">Email</label>
                           <div class="col-sm-10">
                               <input type="email" class="form-control" v-model="basicInfo.email">
                               <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                           </div>
                       </div>
                       <div class="form-group row align-items-center">
                           <label class="col-sm-2 mb-0">Image</label>
                           <div class="col-sm-10">
                               <input type="file" class="form-control-file" accept="image/*"
                                      @change="onImageChange" />
                               <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                           </div>
                       </div>
                       <div class="form-group row align-items-center">
                           <label class="col-sm-2 mb-0">Gender</label>
                           <div class="col-sm-10">
                               <div class="form-check form-check-inline">
                                   <input class="form-check-input" type="radio" value="male" v-model="gender">
                                   <label class="form-check-label">Male</label>
                               </div>
                               <div class="form-check form-check-inline">
                                   <input class="form-check-input" type="radio" value="female" v-model="gender">
                                   <label class="form-check-label">Female</label>
                               </div>

                               <small class="text-danger" v-if="errors.gender">{{ errors.gender[0] }}</small>
                           </div>
                       </div>
                       <div class="form-group row align-items-center">
                           <label class="col-sm-2 mb-0">Skills</label>
                           <div class="col-sm-10">
                               <div class="row">
                                   <div class="col-sm-6" v-for="(skill, index) in allSkills" :key="index">
                                       <input type="checkbox" name="skill" :value="skill.id" v-model="skills">
                                       <label>{{ skill.name }}</label>
                                   </div>
                                   <small class="text-danger" v-if="errors.skills">{{ errors.skills[0] }}</small>
                               </div>
                           </div>
                       </div>
                   </form>
                   <button class="btn btn-outline-primary float-md-right"
                           type="submit"
                           @click.prevent="submit">
                       Submit
                   </button>
               </div>
           </div>
       </div>
   </div>
</template>

<script>
import {formDataAssigner} from "../helpers/Helpers";

export default {
    name: "Registration",
    data() {
        return {
            errors: {},
            basicInfo: {},
            image: '',
            gender: 'male',
            allSkills: [],
            skills: [],
            alert: '',
        }
    },
    created() {
        this.getSkills();
    },
    methods: {
        getSkills() {
            axios.get('/skills')
                .then(response => {
                    this.allSkills = response.data;
                }).catch(error => {})
        },
        submit() {
            let formData = {
                name : this.basicInfo.name,
                email : this.basicInfo.email,
                gender : this.gender,
                image : this.image,
            },
            data = formDataAssigner(new FormData, formData);
            data.append('skills', this.skills)

            axios.post('/store/information', data)
            .then(({data}) => {
                this.alert = data.message;
                setTimeout(() => {
                    this.alert = '';
                    location.reload();
                }, 2500);

            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        },
        onImageChange(event) {
            this.image = event.target.files[0];
        }
    }
}
</script>
