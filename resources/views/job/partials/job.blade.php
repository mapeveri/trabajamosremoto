<div class="card">
    <div class="card-body">
        <h5 class="card-title"><a href="{{ route('jobs.show', ['id' => $job->id, 'slug' => $job->slug]) }}">{{ $job->title }}</a></h5>
        <small>Por: <a href="{{ route('profile', ['username' => $job->user->username]) }}">{{ $job->user->name }}</a></small>
        <hr>
        <p><small class="card-text">
            {{ str_limit(preg_replace("/\s|&nbsp;/", ' ', strip_tags($job->content)), $limit = 350, $end = '...') }}
        </small></p>

        <div class="pull-left">
        @foreach($job->subcategories as $subcategory)
            <span class="badge badge-dark">
                <a href="{{ route('jobs.show_subcategory', ['id' => $job->category_id, 'slug' => $job->category->slug, 'subcategory_id' => $subcategory->id, 'subcategory_slug' => $subcategory->slug]) }}">{{ $subcategory->name }}</a>
            </span>
        @endforeach
        </div>
        <div class="pull-right">
            <small>{{ date('d-m-Y', strtotime($job->created_at)) }}</small>
        </div>
    </div>
</div>
<br>
