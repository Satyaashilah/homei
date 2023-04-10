import axios from axios

export default class UserServices{
    methods: {
        onFileSelected(event) {
            this.selectedFile = event.target.files[0]
        },
        onUpload(){
            const fd = new FormData();
            fd.append('image', this.selectedFile, this.selectedFile.name)
            axios.post('', fd,{
                onUploadProgress: uploadEvent => {
                    console.log('Upload Progress: ' + Math.round(uploadEvent.loaded / uploadEvent.total * 100)+ '%')
                }
            })
            then(res => {
                console.log(res)
            });
        }
    }
}