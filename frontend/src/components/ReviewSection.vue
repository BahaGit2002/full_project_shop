<script>
import StarRating from "./StarRating.vue";
import UserIcon from "./icons/feather-icon/UserIcon.vue";

export default {
  components: {
    UserIcon,
    StarRating,
  },
  data() {
    return {
      comments: [
        {user: 'Татьяна', text: "Отличный товар, рекомендую!", rating: 5, date: "16.06.2025"},
        {user: 'Мария', text: "Хорошее качество за свою цену.", rating: 4, date: "16.06.2025"},
      ],
      newReview: {text: '', rating: 0},
      ratingCounts: {5: 1, 4: 1, 3: 0, 2: 0, 1: 0},
    };
  },
  computed: {
    averageRating() {
      const total = this.comments.reduce((sum, comment) => sum + comment.rating, 0);
      return this.comments.length ? (total / this.comments.length).toFixed(1) : 0;
    },
  },
  methods: {
    getReviewCount(rating) {
      return this.ratingCounts[rating] || 0;
    },
    submitReview() {
      if (this.newReview.text && this.newReview.rating > 0) {
        this.comments.push({
          text: this.newReview.text,
          rating: this.newReview.rating,
          date: new Date().toLocaleDateString(),
        });
        this.ratingCounts[this.newReview.rating] = (this.ratingCounts[this.newReview.rating] || 0) + 1;
        this.newReview.text = '';
        this.newReview.rating = 0;
      }
    },
  },
};
</script>

<template>
  <div class="review space-y-5">
    <h2 class="font-bold text-3xl">Отзывы</h2>
    <div class="space-y-">
      <div class="flex justify-between md:flex-row gap-6">
        <!-- Average Rating & Individual Ratings -->
        <div class="flex-none w-1/5">
          <div class="flex flex-row gap-5 items-center">
            <star-rating :rating="averageRating"></star-rating>
            <span class="text-base font-bold">{{ averageRating }} из 5</span>
          </div>
          <!-- Individual Ratings -->
          <div class="space-y-4 mt-4">
            <div v-for="rating in [5, 4, 3, 2, 1]" :key="rating" class="flex gap-5 items-center">
              {{ rating }}
              <star-rating :rating="rating"></star-rating>
              <span>{{ getReviewCount(rating) }}</span>
            </div>
          </div>
        </div>

        <!-- Comments Section & Review Form  -->
        <div class="flex-none w-3/5 mx-auto">
          <div class="space-y-3">
            <div v-for="(comment, index) in comments" :key="index" class="space-y-2">
              <div class="flex gap-3">
                <UserIcon/>
                <span class="text-base text-gray-800">{{ comment.user }}</span>
              </div>
              <p class="text-gray-700">{{ comment.text }}</p>
              <div class="flex items-center gap-2 mt-2">
                <star-rating :rating="comment.rating"></star-rating>
                <span class="text-sm text-gray-500">{{ comment.date }}</span>
              </div>
            </div>
          </div>

          <div class="mt-6 space-y-4">
            <div class="flex gap-4">
              <h3 class="font-semibold text-xl">Ваша оценка</h3>
              <star-rating
                  v-model="newReview.rating"
                  :rating="newReview.rating"
                  @update:rating="newReview.rating = $event"
              ></star-rating>
            </div>
            <form @submit.prevent="submitReview" class="space-y-4">
              <textarea
                  v-model="newReview.text"
                  class="w-full p-2 border rounded-sm"
                  rows="4"
                  placeholder="Ваш отзыв..."
              ></textarea>
              <button
                  type="submit"
                  class="px-10 py-3 bg-[#FCD5BA] text-orange-500 rounded-sm hover:bg-orange-600"
              >
                Отправить отзыв
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>