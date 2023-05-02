import { useQuery, useMutation, useQueryClient } from "@tanstack/vue-query";
import api from '../stores/api';

const useGetPostsQuery = () => useQuery({
queryKey: ['posts'],
queryFn: async () => {
        const result = await api.get(`posts?page=1`);
            // .then((res) => {
            //     console.log('in');
            //     return res.data;
            // });

            // console.log('out', res);

        return result;
},
});

const useCreatePostMutation = () => {
    const queryClient = useQueryClient();

    return useMutation({
        mutationFn: async (newPost) => {
            return await api.post(`posts`, newPost, {
            headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
        }, 
        onSuccess: (data) => {
            queryClient.invalidateQueries({queryKey: ['posts']});
        }
    })
};

export {useGetPostsQuery, useCreatePostMutation};