<template>
    <section class="services-in-doctor">
        <div class="services-in-doctor__row">
            <label class="services-in-doctor__row_title">Добавление услуг</label>
            <div class="services-in-doctor__row_header">
                <h5 class="services-in-doctor__row_sub-title services-in-doctor__h1">Название услуги</h5>
                <h5 class="services-in-doctor__row_sub-title services-in-doctor__h2">Время выполнения (мин.)</h5>
                <h5 class="services-in-doctor__row_sub-title services-in-doctor__h3">Возрастной диапазон (лет)</h5>
            </div>

            <div class="services-in-doctor__row_service-row" v-for="(item, index) in items">

                <div class="services-in-doctor__services-control">
                    <v-select :options="options" class="services-in-doctor__control" style="border-color: transparent;" />
                </div>

                <template v-for="(input, i) in item.inputs">
                    <div :class="input.classWrapper" v-if="input.type !== 'checkbox'" :key="i">
                        <input :type="input.type" :class="input.class" :placeholder="input.placeholder" :name="arrName(input.name)">
                    </div>
                    <div :class="input.classWrapper" v-else :key="i">
                        <input :type="input.type" :class="input.class" :id="input.name + '-' + index" :name="arrName(input.name)">
                        <label :for="input.name + '-' + index" class="f5-label">{{ input.label }}</label>
                    </div>
                </template>

                <div class="services-in-doctor__btn-close">
                    <button type="button" @click="destroyService" class="btn btn-warning btn-circle btn-close" style="display: block;margin: 0 auto;"><i class="fa fa-times"></i></button>
                </div>

            </div>
        </div>
        <div class="flex-wrapper" style="display: flex; justify-content: center; align-items: center;">
            <button type="button" class="btn btn-info btn-add mb-4" @click="addService">
                <i class="ti-plus text" aria-hidden="true"></i>
            </button>
        </div>
    </section>
</template>

<script>
import vSelect from 'vue-select'

export default {
    components: {
      vSelect
    },
    data() {
      return {
        myProto:  {
            inputs: [
              { name: 'time', placeholder: 'Время выполнения', type: 'number', classWrapper: 'services-in-doctor__time-control', class: 'services-in-doctor__control' },
              { name: 'old_min', placeholder: 'От', type: 'number', classWrapper: 'services-in-doctor__old-control', class: 'services-in-doctor__control' },
              { name: 'old_max', placeholder: 'До', type: 'number', classWrapper: 'services-in-doctor__old-control', class: 'services-in-doctor__control' },
              { name: 'sort', type: 'checkbox', label: 'Top', classWrapper: 'services-in-doctor__top-control ', class: 'chk-col-red services-in-doctor__control' },
            ]
        },
        counter: 0,
        items: [
          {
            inputs: [
              { name: 'time', placeholder: 'Время выполнения', type: 'number', classWrapper: 'services-in-doctor__time-control', class: 'services-in-doctor__control' },
              { name: 'old_min', placeholder: 'От', type: 'number', classWrapper: 'services-in-doctor__old-control', class: 'services-in-doctor__control' },
              { name: 'old_max', placeholder: 'До', type: 'number', classWrapper: 'services-in-doctor__old-control', class: 'services-in-doctor__control' },
              { name: 'sort', type: 'checkbox', label: 'Top', classWrapper: 'services-in-doctor__top-control ', class: 'chk-col-red services-in-doctor__control' },
            ]
          }
        ]
      }
    },
    props: {
        servicesArr: {
            type: [Array, String],
            default: () => [
                { id: 1, title: 'Услуга 1' },
                { id: 2, title: 'Услуга 2' },
                { id: 3, title: 'Услуга 3' }
            ]
        },
     /* items: {
        default: () => {
          return {
            inputs: [
              { name: 'time', placeholder: 'Время выполнения', type: 'number', classWrapper: 'services-in-doctor__time-control', class: 'services-in-doctor__control' },
              { name: 'old_min', placeholder: 'От', type: 'number', classWrapper: 'services-in-doctor__old-control', class: 'services-in-doctor__control' },
              { name: 'old_max', placeholder: 'До', type: 'number', classWrapper: 'services-in-doctor__old-control', class: 'services-in-doctor__control' },
              { name: 'sort', type: 'checkbox', label: 'Top', classWrapper: 'services-in-doctor__top-control ', class: 'chk-col-red services-in-doctor__control' },
            ]
          }
        }
      }*/
    },
    methods: {
        arrName(name) {
            return `service[${this.counter}][${name}]`
        },
        addService() {
            this.counter++
            this.items.push(this.myProto)
        },
        destroyService(id) {
          if (this.items.length === 1) {
            return console.log('Delete fails')
          }
          // this.events.splice(this.events.indexOf(event), 1);
        }
    },
    computed: {
        services() {
            let arr = JSON.parse(this.servicesArr);
            let result = [];
            for(let index in arr) {
                result.push({ id: index, title: arr[index] })
            }
            return result
        },
        options() {
            let arr = JSON.parse(this.servicesArr);
            let result = [];
            for(let index in arr) {
              result.push({ value: index, label: arr[index] })
            }
            return result
        }
    }
}
</script>

<style>
@import "~vue-select/dist/vue-select.css";

.services-in-doctor__row_title {
    color: #1e88e5;
}
.services-in-doctor {
    padding-top: 25px;
    padding-bottom: 25px;
}
.services-in-doctor__row {
    display: flex;
    flex-direction: column;
}
.services-in-doctor__row_header {
    display: flex;
    justify-content: space-around;
    align-items: baseline;
    width: 82%;
}
.services-in-doctor__row_service-row {
    display: flex;
    justify-content: space-around;
    align-items: baseline;
    flex-wrap: wrap;
}
.services-in-doctor__services-control {
    flex: 1 1 30%;
    margin: 0 12px 20px;
}
.services-in-doctor__time-control {
    flex: 1 1 20%;
    margin: 0 12px 20px;

}
.services-in-doctor__old-control {
    flex: 1 1 10%;
    margin: 0 12px 20px;
}
.services-in-doctor__top-control {
    flex: 1 1 5%;
    display: flex;
    justify-content: space-around;
    margin: 0 12px 20px;
}
.services-in-doctor__control {
    width: 100%;
    padding: 10px;
    border: 1px solid #1e88e5;
    border-radius: 4px;
    min-width: 50px;
}
.services-in-doctor__btn-close {
    flex: 1 1 10%;
}
.services-in-doctor__row_sub-title {
    font-size: 20px;
    margin-bottom: 22px;
}
.services-in-doctor__h1 {
    flex: 0 0 38%;
    text-align: center;
}
.services-in-doctor__h2 {
    flex: 0 0 27%;
    text-align: center;
}
.services-in-doctor__h3 {
    flex: 0 0 30%;
    text-align: center;
}
</style>
