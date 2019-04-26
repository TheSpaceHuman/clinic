<template>
    <section class="services-in-doctor">
        <div class="form-group append row">
            <label class="card-title col-md-12">Добавление услуг</label>
            <h5 class="card-title col-md-6 my-3">Название услуги</h5>
            <h5 class="card-title col-md-3 my-3">Время выполнения (мин.)</h5>
            <h5 class="card-title col-md-3 my-3">Возрастной диапазон (лет)</h5>

            <div class="row copy-block col-12" v-for="(item, index) in items">
                <div class="form-group col-md-5">
                    <select name="service[]" id="service" class="form-control">
                        <option :value="service.id" v-for="service in services">{{ service.title }}</option>
                    </select>
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

                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-warning btn-circle btn-close" style="display: block;margin: 0 auto;"><i class="fa fa-times"></i></button>
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
export default {
    data() {
      return {
        myProto:  {
            inputs: [
                { name: 'time', placeholder: 'Время выполнения', type: 'number', classWrapper: 'form-group col-md-3', class: 'form-control' },
                { name: 'old_min', placeholder: 'От', type: 'number', classWrapper: 'form-group col-md-1', class: 'form-control' },
                { name: 'old_max', placeholder: 'До', type: 'number', classWrapper: 'form-group col-md-1', class: 'form-control' },
                { name: 'sort', type: 'checkbox', label: 'Top', classWrapper: 'form-group col-md-1', class: 'chk-col-red' },
            ]
        },
        items: [
            {
                inputs: [
                    { name: 'time', placeholder: 'Время выполнения', type: 'number', classWrapper: 'form-group col-md-3', class: 'form-control' },
                    { name: 'old_min', placeholder: 'От', type: 'number', classWrapper: 'form-group col-md-1', class: 'form-control' },
                    { name: 'old_max', placeholder: 'До', type: 'number', classWrapper: 'form-group col-md-1', class: 'form-control' },
                    { name: 'sort', type: 'checkbox', label: 'Top', classWrapper: 'form-group col-md-1', class: 'chk-col-red' },
                ]
            }
        ],
        counter: 0,
      }
    },
    props: {
        servicesArr: {
            type: [Array, String],
            default: () => [
                { id: 1, title: 'Услуга 1' },
                { id: 2, title: 'Услуга 2' },
                { id: 3, title: 'Услуга 3' },
                { id: 4, title: 'Услуга 4' },
                { id: 5, title: 'Услуга 5' },
                { id: 6, title: 'Услуга 6' },
                { id: 7, title: 'Услуга 7' },
                { id: 8, title: 'Услуга 8' }
            ]
        }
    },
    methods: {
        arrName(name) {
            return `service[${this.counter}][${name}]`
        },
        addService() {
            this.counter++
            this.items.push(this.myProto)
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
        }
    },

}
</script>

<style>

</style>
